<?php

namespace Tests\Feature;

use App\Models\Bahasa;
use App\Models\Mitra;
use App\Models\MitraIntro;
use App\Models\User;
use App\Support\ImageOptimizer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ImageOptimizerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    /**
     * Gambar berpola acak per blok agar ukurannya mendekati foto/logo sungguhan.
     */
    protected function makeImage(int $width, int $height, string $type = 'jpeg', bool $transparentBorder = false): string
    {
        $image = imagecreatetruecolor($width, $height);
        imagealphablending($image, false);
        imagesavealpha($image, true);

        mt_srand(42);
        for ($x = 0; $x < $width; $x += 25) {
            for ($y = 0; $y < $height; $y += 25) {
                $color = imagecolorallocatealpha($image, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255), 0);
                imagefilledrectangle($image, $x, $y, $x + 24, $y + 24, $color);
            }
        }

        if ($transparentBorder) {
            $clear = imagecolorallocatealpha($image, 0, 0, 0, 127);
            imagefilledrectangle($image, 0, 0, $width - 1, (int) ($height / 4), $clear);
        }

        $path = tempnam(sys_get_temp_dir(), 'img');
        $type === 'png' ? imagepng($image, $path) : imagejpeg($image, $path, 95);

        return $path;
    }

    protected function upload(string $path, string $name, string $mime): UploadedFile
    {
        return new UploadedFile($path, $name, $mime, null, true);
    }

    public function test_large_jpeg_is_resized_and_converted_to_webp(): void
    {
        $source = $this->makeImage(3000, 2000);

        $name = ImageOptimizer::store($this->upload($source, 'foto.jpg', 'image/jpeg'), 'berita', 1920);

        // Tanpa label, nama diambil dari nama file asli.
        $this->assertMatchesRegularExpression('/^foto-[a-z0-9]{6}\.webp$/', $name);
        $stored = Storage::disk('public')->get('berita/'.$name);
        [$width, $height, $type] = getimagesizefromstring($stored);

        $this->assertSame(IMAGETYPE_WEBP, $type);
        $this->assertSame([1920, 1280], [$width, $height]);
        $this->assertLessThan(filesize($source), strlen($stored));
    }

    public function test_png_logo_keeps_its_transparency(): void
    {
        $source = $this->makeImage(1200, 800, 'png', transparentBorder: true);

        $name = ImageOptimizer::store($this->upload($source, 'Logo Final (1).png', 'image/png'), 'mitra', 600, 'Badan Perfilman Indonesia');

        $this->assertMatchesRegularExpression('/^badan-perfilman-indonesia-[a-z0-9]{6}\.webp$/', $name);

        $image = imagecreatefromstring(Storage::disk('public')->get('mitra/'.$name));
        $this->assertSame([600, 400], [imagesx($image), imagesy($image)]);
        $this->assertSame(127, (imagecolorat($image, 10, 10) >> 24) & 0x7F, 'Area transparan harus tetap transparan');
        $this->assertSame(0, (imagecolorat($image, 300, 350) >> 24) & 0x7F, 'Area logo harus tetap solid');
    }

    public function test_animated_gif_is_stored_untouched(): void
    {
        $frame = "\x21\xF9\x04\x00\x0A\x00\x00\x00"
            ."\x2C\x00\x00\x00\x00\x01\x00\x01\x00\x00"
            ."\x02\x02\x44\x01\x00";
        $gif = "GIF89a\x01\x00\x01\x00\x80\x00\x00\x00\x00\x00\xFF\xFF\xFF".$frame.$frame."\x3B";

        $path = tempnam(sys_get_temp_dir(), 'gif');
        file_put_contents($path, $gif);

        $name = ImageOptimizer::store($this->upload($path, 'anim.gif', 'image/gif'), 'berita', 1920);

        $this->assertStringEndsWith('.gif', $name);
        $this->assertSame($gif, Storage::disk('public')->get('berita/'.$name));
    }

    public function test_unreadable_image_falls_back_to_original_file(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'bad');
        file_put_contents($path, 'bukan gambar');

        $name = ImageOptimizer::store($this->upload($path, 'rusak.jpg', 'image/jpeg'), 'berita', 1920);

        $this->assertMatchesRegularExpression('/^rusak-[a-z0-9]{6}\.txt$/', $name);
        $this->assertSame('bukan gambar', Storage::disk('public')->get('berita/'.$name));
    }

    public function test_partner_logo_upload_is_saved_as_small_webp(): void
    {
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        Bahasa::create(['kode' => 'id', 'nama' => 'Indonesia', 'aktif' => true, 'is_default' => true]);

        $source = $this->makeImage(1600, 800, 'png');

        $this->actingAs($admin)
            ->post(route('admin.mitra.store'), [
                'status' => 1,
                'logo' => $this->upload($source, 'logo.png', 'image/png'),
                'translations' => ['id' => ['nama' => 'Partner A', 'kategori' => 'Media']],
            ])
            ->assertSessionHasNoErrors();

        $logo = Mitra::firstOrFail()->logo;
        $this->assertMatchesRegularExpression('/^partner-a-[a-z0-9]{6}\.webp$/', $logo);
        $this->assertSame([600, 300], array_slice(getimagesizefromstring(Storage::disk('public')->get('mitra/'.$logo)), 0, 2));
    }

    public function test_command_converts_existing_images_and_updates_every_reference(): void
    {
        Bahasa::create(['kode' => 'id', 'nama' => 'Indonesia', 'aktif' => true, 'is_default' => true]);
        Storage::disk('public')->put('mitra/lama.jpg', file_get_contents($this->makeImage(2400, 1200)));
        $first = Mitra::create(['logo' => 'lama.jpg', 'status' => true]);
        $first->storeTranslations(['id' => ['nama' => 'Partner Satu', 'kategori' => 'Media']]);
        $second = Mitra::create(['logo' => 'lama.jpg', 'status' => true]);
        $intro = MitraIntro::create(['gambar' => 'lama.jpg', 'status' => true]);

        $this->artisan('images:optimize', ['--dry-run' => true])->assertSuccessful();
        $this->assertSame('lama.jpg', $first->refresh()->logo);
        Storage::disk('public')->assertExists('mitra/lama.jpg');

        $this->artisan('images:optimize')->assertSuccessful();

        $new = $first->refresh()->logo;
        $this->assertMatchesRegularExpression('/^partner-satu-[a-z0-9]{6}\.webp$/', $new);
        $this->assertSame($new, $second->refresh()->logo);
        $this->assertSame($new, $intro->refresh()->gambar);
        Storage::disk('public')->assertMissing('mitra/lama.jpg');

        // File dipakai logo Mitra, jadi ukuran terkecil (600px) yang berlaku.
        $this->assertSame([600, 300], array_slice(getimagesizefromstring(Storage::disk('public')->get('mitra/'.$new)), 0, 2));

        // Jalan kedua tidak meng-encode ulang file WebP yang sudah sesuai.
        $this->artisan('images:optimize')->assertSuccessful();
        $this->assertSame($new, $first->refresh()->logo);
    }

    public function test_command_rename_option_gives_old_random_names_a_readable_name(): void
    {
        Bahasa::create(['kode' => 'id', 'nama' => 'Indonesia', 'aktif' => true, 'is_default' => true]);
        $random = str_repeat('aB3', 13).'x.webp';
        ob_start();
        imagewebp(imagecreatefrompng($this->makeImage(400, 200, 'png')));
        $webp = ob_get_clean();
        Storage::disk('public')->put('mitra/'.$random, $webp);
        $mitra = Mitra::create(['logo' => $random, 'status' => true]);
        $mitra->storeTranslations(['id' => ['nama' => 'Partner Dua', 'kategori' => 'Media']]);

        // Tanpa --rename file yang sudah optimal dibiarkan.
        $this->artisan('images:optimize')->assertSuccessful();
        $this->assertSame($random, $mitra->refresh()->logo);

        $this->artisan('images:optimize', ['--rename' => true])->assertSuccessful();

        $renamed = $mitra->refresh()->logo;
        $this->assertMatchesRegularExpression('/^partner-dua-[a-z0-9]{6}\.webp$/', $renamed);
        $this->assertSame($webp, Storage::disk('public')->get('mitra/'.$renamed), 'Isi file tidak boleh di-encode ulang');
        Storage::disk('public')->assertMissing('mitra/'.$random);
    }
}
