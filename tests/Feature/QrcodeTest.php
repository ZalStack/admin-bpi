<?php

namespace Tests\Feature;

use App\Models\Qrcode;
use App\Models\Shortlink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class QrcodeTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        config(['shortlink.base_url' => 'https://bpi.test']);

        foreach (['super_admin', 'admin', 'editor'] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin');
    }

    protected function payload(array $overrides = []): array
    {
        return array_merge([
            'judul' => 'Event Poster',
            'sumber' => 'url',
            'url_tujuan' => 'https://example.com/event',
            'warna_depan' => '#16336d',
            'warna_latar' => '#FFFFFF',
            'logo_mode' => 'bpi',
            'caption' => 'Scan to register',
        ], $overrides);
    }

    public function test_qrcode_linked_to_shortlink_encodes_short_url(): void
    {
        $shortlink = Shortlink::create(['kode' => 'event', 'url_tujuan' => 'https://example.com/event', 'status' => true]);

        $this->actingAs($this->admin)
            ->post(route('admin.qrcode.store'), $this->payload([
                'sumber' => 'shortlink',
                'shortlink_id' => $shortlink->id,
            ]))
            ->assertRedirect(route('admin.qrcode.index'))
            ->assertSessionHasNoErrors();

        $qrcode = Qrcode::firstOrFail();
        $this->assertNull($qrcode->url_tujuan);
        $this->assertSame('#16336D', $qrcode->warna_depan);
        $this->assertSame('https://bpi.test/event', $qrcode->konten);
    }

    public function test_qrcode_with_custom_url_encodes_it_directly(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.qrcode.store'), $this->payload(['shortlink_id' => '']))
            ->assertSessionHasNoErrors();

        $qrcode = Qrcode::firstOrFail();
        $this->assertNull($qrcode->shortlink_id);
        $this->assertSame('https://example.com/event', $qrcode->konten);
    }

    public function test_validation_rejects_missing_target_and_bad_colors(): void
    {
        $this->actingAs($this->admin)
            ->post(route('admin.qrcode.store'), $this->payload(['sumber' => 'shortlink', 'warna_latar' => 'white']))
            ->assertSessionHasErrors(['shortlink_id', 'warna_latar']);

        $this->actingAs($this->admin)
            ->post(route('admin.qrcode.store'), $this->payload(['url_tujuan' => '']))
            ->assertSessionHasErrors('url_tujuan');

        $this->assertSame(0, Qrcode::count());
    }

    public function test_uploaded_logo_is_required_stored_and_removed_when_switching_mode(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin)
            ->post(route('admin.qrcode.store'), $this->payload(['logo_mode' => 'upload']))
            ->assertSessionHasErrors('logo');

        $this->actingAs($this->admin)
            ->post(route('admin.qrcode.store'), $this->payload([
                'logo_mode' => 'upload',
                'logo' => UploadedFile::fake()->image('logo.png', 200, 200),
            ]))
            ->assertSessionHasNoErrors();

        $qrcode = Qrcode::firstOrFail();
        Storage::disk('public')->assertExists('qrcode/'.$qrcode->logo);
        $this->assertStringContainsString('/storage/qrcode/'.$qrcode->logo, $qrcode->logo_url);

        // Update tanpa file baru tetap memakai logo lama.
        $this->actingAs($this->admin)
            ->put(route('admin.qrcode.update', $qrcode->id), $this->payload(['logo_mode' => 'upload']))
            ->assertSessionHasNoErrors();

        $oldLogo = $qrcode->logo;
        $this->actingAs($this->admin)
            ->put(route('admin.qrcode.update', $qrcode->id), $this->payload(['logo_mode' => 'none']))
            ->assertSessionHasNoErrors();

        $this->assertNull($qrcode->refresh()->logo);
        $this->assertNull($qrcode->logo_url);
        Storage::disk('public')->assertMissing('qrcode/'.$oldLogo);
    }

    public function test_pages_render_for_admin_and_are_forbidden_for_editor(): void
    {
        $shortlink = Shortlink::create(['kode' => 'event', 'url_tujuan' => 'https://example.com/event', 'status' => true]);
        $qrcode = Qrcode::create(['judul' => 'Poster', 'shortlink_id' => $shortlink->id]);

        $this->actingAs($this->admin)->get(route('admin.qrcode.index'))->assertOk()->assertSee('https://bpi.test/event');
        $this->actingAs($this->admin)->get(route('admin.qrcode.create', ['shortlink' => $shortlink->id]))->assertOk();
        $this->actingAs($this->admin)->get(route('admin.qrcode.edit', $qrcode->id))->assertOk();
        $this->actingAs($this->admin)->get(route('admin.shortlink.create'))->assertOk();
        $this->actingAs($this->admin)->get(route('admin.shortlink.edit', $shortlink->id))->assertOk();

        $editor = User::factory()->create();
        $editor->assignRole('editor');
        $this->actingAs($editor)->get(route('admin.qrcode.index'))->assertForbidden();
    }
}
