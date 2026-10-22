<?php

namespace Tests\Feature;

use App\Models\Qrcode;
use App\Models\Shortlink;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ShortlinkTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['shortlink.base_url' => 'https://bpi.test']);

        foreach (['super_admin', 'admin', 'editor'] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
    }

    protected function userWithRole(string $role): User
    {
        $user = User::factory()->create();
        $user->assignRole($role);

        return $user;
    }

    protected function makeShortlink(array $attributes = []): Shortlink
    {
        return Shortlink::create(array_merge([
            'kode' => 'promo',
            'url_tujuan' => 'https://example.com/landing',
            'status' => true,
        ], $attributes));
    }

    public function test_admin_can_create_shortlink_with_normalized_custom_code(): void
    {
        $admin = $this->userWithRole('admin');

        $this->actingAs($admin)
            ->post(route('admin.shortlink.store'), [
                'kode' => ' Annual-Report-2026 ',
                'url_tujuan' => 'https://example.com/report.pdf',
                'judul' => 'Annual report',
                'status' => '1',
            ])
            ->assertRedirect(route('admin.shortlink.index'))
            ->assertSessionHasNoErrors();

        $shortlink = Shortlink::firstOrFail();
        $this->assertSame('annual-report-2026', $shortlink->kode);
        $this->assertSame($admin->id, $shortlink->created_by);
        $this->assertSame('https://bpi.test/annual-report-2026', $shortlink->short_url);
    }

    public function test_empty_code_is_generated_automatically(): void
    {
        $this->actingAs($this->userWithRole('super_admin'))
            ->post(route('admin.shortlink.store'), [
                'kode' => '',
                'url_tujuan' => 'https://example.com',
                'status' => '1',
            ])
            ->assertSessionHasNoErrors();

        $this->assertMatchesRegularExpression('/^[a-z0-9]{6}$/', Shortlink::firstOrFail()->kode);
    }

    public function test_reserved_invalid_and_duplicate_codes_are_rejected(): void
    {
        $admin = $this->userWithRole('admin');
        $this->makeShortlink(['kode' => 'taken']);

        foreach (['news', 'privacy-policy', 'ab', 'bad_code', 'double--hyphen', '-start', 'taken'] as $kode) {
            $this->actingAs($admin)
                ->post(route('admin.shortlink.store'), ['kode' => $kode, 'url_tujuan' => 'https://example.com'])
                ->assertSessionHasErrors('kode');
        }

        $this->assertSame(1, Shortlink::count());
    }

    public function test_destination_must_be_http_url_and_not_another_shortlink(): void
    {
        $admin = $this->userWithRole('admin');
        $this->makeShortlink(['kode' => 'existing']);

        foreach (['javascript:alert(1)', 'ftp://example.com/file', 'https://bpi.test/existing', 'https://BPI.test/self-loop/'] as $url) {
            $this->actingAs($admin)
                ->post(route('admin.shortlink.store'), ['kode' => 'self-loop', 'url_tujuan' => $url])
                ->assertSessionHasErrors('url_tujuan');
        }

        // Halaman landing biasa di domain yang sama tetap boleh.
        $this->actingAs($admin)
            ->post(route('admin.shortlink.store'), ['kode' => 'go-news', 'url_tujuan' => 'https://bpi.test/news/some-article'])
            ->assertSessionHasNoErrors();
    }

    public function test_update_keeps_own_code_and_can_disable(): void
    {
        $shortlink = $this->makeShortlink();

        $this->actingAs($this->userWithRole('admin'))
            ->put(route('admin.shortlink.update', $shortlink->id), [
                'kode' => 'promo',
                'url_tujuan' => 'https://example.com/new-target',
            ])
            ->assertSessionHasNoErrors();

        $shortlink->refresh();
        $this->assertSame('https://example.com/new-target', $shortlink->url_tujuan);
        $this->assertFalse($shortlink->status);
    }

    public function test_shortlink_used_by_qrcode_cannot_be_deleted(): void
    {
        $shortlink = $this->makeShortlink();
        Qrcode::create(['judul' => 'Poster', 'shortlink_id' => $shortlink->id]);

        $this->actingAs($this->userWithRole('admin'))
            ->delete(route('admin.shortlink.destroy', $shortlink->id))
            ->assertSessionHas('error');

        $this->assertModelExists($shortlink);
    }

    public function test_only_super_admin_and_admin_can_manage_shortlinks(): void
    {
        $this->get(route('admin.shortlink.index'))->assertRedirect(route('login'));

        $this->actingAs($this->userWithRole('editor'))
            ->get(route('admin.shortlink.index'))
            ->assertForbidden();

        $this->makeShortlink();

        $this->actingAs($this->userWithRole('admin'))
            ->get(route('admin.shortlink.index'))
            ->assertOk()
            ->assertSee('https://bpi.test/promo');
    }

    public function test_resolve_returns_destination_and_counts_click(): void
    {
        $shortlink = $this->makeShortlink();
        $updatedAt = $shortlink->updated_at;

        $this->travel(5)->minutes();

        $this->getJson('/api/admin/v1/shortlink/resolve/PROMO')
            ->assertOk()
            ->assertJsonPath('data.url', 'https://example.com/landing');

        $shortlink->refresh();
        $this->assertSame(1, $shortlink->jumlah_klik);
        $this->assertNotNull($shortlink->terakhir_diklik_at);
        $this->assertTrue($updatedAt->equalTo($shortlink->updated_at));
    }

    public function test_resolve_returns_404_for_unknown_or_inactive_code(): void
    {
        $this->makeShortlink(['kode' => 'off', 'status' => false]);

        $this->getJson('/api/admin/v1/shortlink/resolve/off')->assertNotFound();
        $this->getJson('/api/admin/v1/shortlink/resolve/missing')->assertNotFound();
        $this->assertSame(0, Shortlink::firstOrFail()->jumlah_klik);
    }

    public function test_api_does_not_expose_shortlink_list(): void
    {
        $this->makeShortlink();

        $this->getJson('/api/admin/v1/shortlink')->assertNotFound();
        $this->getJson('/api/admin/v1/shortlink/1')->assertNotFound();
    }
}
