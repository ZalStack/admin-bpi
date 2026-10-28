<?php

namespace Tests\Feature;

use App\Models\Bahasa;
use App\Models\BannerHalaman;
use App\Models\KontenHalaman;
use App\Models\ProgramRoadmap;
use App\Models\Proyek;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Tab bahasa non-default (EN) boleh dikosongkan: isinya disalin dari bahasa default (ID).
 */
class TerjemahanKosongTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Bahasa::create(['kode' => 'id', 'nama' => 'Bahasa Indonesia', 'aktif' => true, 'is_default' => true]);
        Bahasa::create(['kode' => 'en', 'nama' => 'English', 'aktif' => true, 'is_default' => false]);
        Bahasa::clearCache();

        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    public function test_empty_english_fields_are_copied_from_indonesian(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.banner.store'), [
                'halaman' => 'home',
                'urutan' => 1,
                'status' => 1,
                'translations' => [
                    'id' => ['judul' => 'Judul Banner', 'deskripsi' => 'Deskripsi banner'],
                    'en' => ['judul' => '', 'deskripsi' => 'English description'],
                ],
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('admin.banner.index'));

        $en = BannerHalaman::first()->translationFor('en');

        $this->assertSame('Judul Banner', $en->judul);
        $this->assertSame('English description', $en->deskripsi);
    }

    public function test_indonesian_required_fields_cannot_be_emptied_on_update(): void
    {
        $banner = BannerHalaman::create(['halaman' => 'home', 'urutan' => 1, 'status' => true]);
        $banner->storeTranslations(['id' => ['judul' => 'Lama', 'deskripsi' => 'Lama']]);

        $this->actingAs($this->admin)
            ->put(route('admin.banner.update', $banner->id), [
                'halaman' => 'home',
                'status' => 1,
                'translations' => [
                    'id' => ['judul' => '', 'deskripsi' => 'Baru'],
                    'en' => ['judul' => '', 'deskripsi' => ''],
                ],
            ])
            ->assertSessionHasErrors('translations.id.judul');

        $this->assertSame('Lama', $banner->fresh()->translationFor('id')->judul);
    }

    public function test_project_lists_are_copied_when_english_tab_is_empty(): void
    {
        $kosong = [
            'judul' => '', 'deskripsi_singkat' => '', 'deskripsi' => '', 'lokasi' => '', 'timeline' => '',
            'tujuan' => [['icon' => 'fa-solid fa-handshake', 'deskripsi' => '']],
            'linimasa_proyek' => [['tahun' => '', 'deskripsi' => '']],
        ];

        $this->actingAs($this->admin)
            ->post(route('admin.proyek.store'), [
                'tahun' => '2026',
                'status' => 'draft',
                'translations' => [
                    'id' => [
                        'judul' => 'Proyek A', 'deskripsi_singkat' => 'Singkat', 'deskripsi' => 'Lengkap',
                        'lokasi' => 'Jakarta', 'timeline' => '2026',
                        'tujuan' => [['icon' => 'fa-solid fa-star', 'deskripsi' => 'Tujuan satu']],
                        'linimasa_proyek' => [['tahun' => '2026', 'deskripsi' => 'Mulai']],
                    ],
                    'en' => $kosong,
                ],
            ])
            ->assertSessionHasNoErrors();

        $en = Proyek::first()->translations()->where('bahasa', 'en')->with(['tujuan', 'linimasa_proyek'])->first();

        $this->assertSame('Proyek A', $en->judul);
        $this->assertSame('Jakarta', $en->lokasi);
        $this->assertSame(['Tujuan satu'], $en->tujuan->pluck('deskripsi')->all());
        $this->assertSame(['Mulai'], $en->linimasa_proyek->pluck('deskripsi')->all());
    }

    public function test_roadmap_points_are_copied_when_english_tab_is_empty(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.program-roadmap.store'), [
                'tahun' => '2026',
                'status' => 1,
                'translations' => [
                    'id' => ['judul' => 'Fondasi', 'deskripsi' => 'Tahun pertama', 'items' => ['Poin satu', 'Poin dua']],
                    'en' => ['judul' => '', 'deskripsi' => '', 'items' => ['']],
                ],
            ])
            ->assertSessionHasNoErrors();

        $en = ProgramRoadmap::first()->translations()->where('bahasa', 'en')->first();

        $this->assertSame('Fondasi', $en->judul);
        $this->assertSame(['Poin satu', 'Poin dua'], $en->items);
    }

    public function test_empty_page_texts_keep_the_website_default(): void
    {
        $item = KontenHalaman::create(['halaman' => 'beranda', 'kunci' => 'tes.judul', 'grup' => 'Tes', 'label' => 'Title', 'tipe' => 'text', 'urutan' => 1]);

        $this->actingAs($this->admin)
            ->put(route('admin.beranda.texts.update'), [
                'konten' => [$item->id => ['id' => 'Judul Indonesia', 'en' => '']],
            ])
            ->assertSessionHasNoErrors();

        $this->assertSame('Judul Indonesia', $item->fresh()->translationFor('id')->nilai);
        $this->assertNull($item->fresh()->translationFor('en')?->nilai);
    }
}
