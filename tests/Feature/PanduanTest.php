<?php

namespace Tests\Feature;

use App\Models\User;
use App\Support\Panduan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PanduanTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

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

    public function test_every_chapter_exists_and_renders_in_every_language(): void
    {
        $superAdmin = $this->userWithRole('super_admin');

        foreach (array_keys(Panduan::BAHASA) as $bahasa) {
            foreach (array_keys(Panduan::BAB) as $slug) {
                $this->assertFileExists(Panduan::path($slug, $bahasa));

                $html = Panduan::render($slug, $superAdmin, $bahasa)['html'];

                $this->assertNotEmpty($html, "Chapter {$bahasa}/{$slug} is empty");
                $this->assertStringNotContainsString('href="bab:', $html, "Chapter {$bahasa}/{$slug} has an unresolved chapter link");
                $this->assertStringNotContainsString('href="cms:', $html, "Chapter {$bahasa}/{$slug} has an unresolved CMS link");
            }

            $this->assertCount(count(Panduan::BAB), glob(resource_path("panduan/{$bahasa}/*.md")), "panduan/{$bahasa} has files that are not registered in Panduan::BAB");
        }
    }

    public function test_links_images_and_anchors_are_valid_in_every_language(): void
    {
        $superAdmin = $this->userWithRole('super_admin');

        foreach (array_keys(Panduan::BAHASA) as $bahasa) {
            $ids = [];
            foreach (array_keys(Panduan::BAB) as $slug) {
                preg_match_all('/ id="([^"]+)"/', Panduan::render($slug, $superAdmin, $bahasa)['html'], $m);
                $ids[$slug] = $m[1];
            }

            foreach (array_keys(Panduan::BAB) as $slug) {
                $markdown = file_get_contents(Panduan::path($slug, $bahasa));
                $lokasi = "{$bahasa}/{$slug}";

                preg_match_all('/\]\(bab:([a-z0-9-]+)(?:#([^)\s]+))?\)/', $markdown, $babs, PREG_SET_ORDER);
                foreach ($babs as $link) {
                    $this->assertArrayHasKey($link[1], Panduan::BAB, "{$lokasi} links to unknown chapter {$link[1]}");

                    if (! empty($link[2])) {
                        $this->assertContains($link[2], $ids[$link[1]], "{$lokasi} links to missing heading {$link[1]}#{$link[2]}");
                    }
                }

                preg_match_all('/\]\(#([^)\s]+)\)/', $markdown, $anchors);
                foreach ($anchors[1] as $anchor) {
                    $this->assertContains($anchor, $ids[$slug], "{$lokasi} links to missing heading #{$anchor}");
                }

                preg_match_all('#\]\((/images/panduan/[^)\s]+)\)#', $markdown, $images);
                foreach ($images[1] as $image) {
                    $this->assertFileExists(public_path($image), "{$lokasi} shows a missing image {$image}");
                }

                preg_match_all('/\]\(cms:([a-z0-9.\-_]+)\)/', $markdown, $routes);
                foreach ($routes[1] as $route) {
                    $this->assertTrue(Route::has($route), "{$lokasi} links to unknown route {$route}");
                }
            }
        }
    }

    public function test_language_toggle_switches_and_is_remembered(): void
    {
        $admin = $this->userWithRole('admin');

        $this->actingAs($admin)
            ->get(route('admin.panduan.show', 'banner'))
            ->assertOk()
            ->assertSee('Menambah banner');

        $this->actingAs($admin)
            ->get(route('admin.panduan.show', ['banner', 'lang' => 'en']))
            ->assertOk()
            ->assertSee('Adding a banner')
            ->assertSessionHas(Panduan::SESSION_KEY, 'en');

        // Bab lain dan daftar isi tetap memakai bahasa yang terakhir dipilih.
        $this->actingAs($admin)
            ->get(route('admin.panduan.show', 'menu'))
            ->assertSee('Adding a menu item');

        $this->actingAs($admin)
            ->get(route('admin.panduan.index'))
            ->assertSee(Panduan::TEKS['en']['judul_index'])
            ->assertSee(Panduan::BAB['banner']['ringkasan']['en']);

        // Bahasa yang tidak dikenal kembali ke default.
        $this->actingAs($admin)
            ->get(route('admin.panduan.show', ['banner', 'lang' => 'xx']))
            ->assertSee('Menambah banner');
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get(route('admin.panduan.index'))->assertRedirect(route('login'));
    }

    public function test_editor_only_sees_chapters_for_editors(): void
    {
        $editor = $this->userWithRole('editor');

        $this->actingAs($editor)
            ->get(route('admin.panduan.index'))
            ->assertOk()
            ->assertSee(route('admin.panduan.show', 'berita'))
            ->assertDontSee(route('admin.panduan.show', 'banner'));

        $this->actingAs($editor)->get(route('admin.panduan.show', 'berita'))->assertOk();
        $this->actingAs($editor)->get(route('admin.panduan.show', 'banner'))->assertForbidden();
        $this->actingAs($editor)->get(route('admin.panduan.show', 'role'))->assertForbidden();

        $this->actingAs($editor)
            ->get(route('admin.panduan.cetak'))
            ->assertOk()
            ->assertSee('id="bab-berita"', false)
            ->assertDontSee('id="bab-proyek"', false);
    }

    public function test_links_to_chapters_outside_the_role_are_plain_text(): void
    {
        $html = Panduan::render('mulai', $this->userWithRole('editor'))['html'];

        $this->assertStringContainsString(route('admin.panduan.show', 'berita'), $html);
        $this->assertStringNotContainsString(route('admin.panduan.show', 'banner'), $html);
    }

    public function test_admin_cannot_read_super_admin_chapter(): void
    {
        $admin = $this->userWithRole('admin');

        $this->actingAs($admin)->get(route('admin.panduan.show', 'banner'))->assertOk();
        $this->actingAs($admin)->get(route('admin.panduan.show', 'role'))->assertForbidden();

        $this->actingAs($this->userWithRole('super_admin'))
            ->get(route('admin.panduan.show', 'role'))
            ->assertOk()
            ->assertSee('Role Management');
    }

    public function test_unknown_chapter_returns_not_found(): void
    {
        $this->actingAs($this->userWithRole('admin'))
            ->get(route('admin.panduan.show', 'tidak-ada'))
            ->assertNotFound();
    }

    public function test_cms_pages_show_a_help_button_for_their_chapter(): void
    {
        $this->assertSame('banner', Panduan::babUntukRoute('admin.banner.edit', $this->userWithRole('admin')));
        $this->assertSame('pesan-kontak', Panduan::babUntukRoute('admin.kontak-form.show', $this->userWithRole('admin')));
        $this->assertNull(Panduan::babUntukRoute('admin.banner.index', $this->userWithRole('editor')));

        $this->actingAs($this->userWithRole('editor'))
            ->get(route('admin.berita.index'))
            ->assertOk()
            ->assertSee(route('admin.panduan.show', 'berita'))
            ->assertSee('Page Guide');
    }
}
