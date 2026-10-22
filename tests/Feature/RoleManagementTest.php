<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (['super_admin', 'admin', 'editor'] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
    }

    protected function userWithRole(string $role, array $attributes = []): User
    {
        $user = User::factory()->create($attributes);
        $user->assignRole($role);

        return $user;
    }

    public function test_only_super_admin_can_access_role_management(): void
    {
        $this->actingAs($this->userWithRole('super_admin'))
            ->get(route('admin.role-management.index'))
            ->assertOk()
            ->assertSee('Role Management');

        $this->actingAs($this->userWithRole('super_admin'))
            ->get(route('admin.role-management.create'))
            ->assertOk()
            ->assertSee('Editor');

        $this->actingAs($this->userWithRole('admin'))
            ->get(route('admin.role-management.index'))
            ->assertForbidden();

        $this->actingAs($this->userWithRole('editor'))
            ->post(route('admin.role-management.store'), [])
            ->assertForbidden();
    }

    public function test_super_admin_can_add_admin_and_editor(): void
    {
        $superAdmin = $this->userWithRole('super_admin');

        foreach (['admin', 'editor'] as $role) {
            $this->actingAs($superAdmin)
                ->post(route('admin.role-management.store'), [
                    'name' => ucfirst($role).' Baru',
                    'email' => " {$role}.baru@BPI.com ",
                    'role' => $role,
                    'password' => 'Rahasia123!',
                    'password_confirmation' => 'Rahasia123!',
                ])
                ->assertRedirect(route('admin.role-management.index'))
                ->assertSessionHasNoErrors();

            $user = User::where('email', "{$role}.baru@bpi.com")->firstOrFail();
            $this->assertTrue($user->hasRole($role));
            $this->assertTrue(Hash::check('Rahasia123!', $user->password));
            $this->assertNotNull($user->email_verified_at);
        }
    }

    public function test_super_admin_role_cannot_be_assigned(): void
    {
        $this->actingAs($this->userWithRole('super_admin'))
            ->post(route('admin.role-management.store'), [
                'name' => 'Penyusup',
                'email' => 'penyusup@bpi.com',
                'role' => 'super_admin',
                'password' => 'Rahasia123!',
                'password_confirmation' => 'Rahasia123!',
            ])
            ->assertSessionHasErrors('role');

        $this->assertDatabaseMissing('users', ['email' => 'penyusup@bpi.com']);
    }

    public function test_super_admin_can_change_role_without_changing_password(): void
    {
        $editor = $this->userWithRole('editor', ['password' => 'LamaSekali123!']);
        $superAdmin = $this->userWithRole('super_admin');

        $this->actingAs($superAdmin)
            ->get(route('admin.role-management.edit', $editor->id))
            ->assertOk()
            ->assertSee($editor->email);

        $this->actingAs($superAdmin)
            ->put(route('admin.role-management.update', $editor->id), [
                'name' => 'Promoted Editor',
                'email' => $editor->email,
                'role' => 'admin',
                'password' => '',
                'password_confirmation' => '',
            ])
            ->assertRedirect(route('admin.role-management.index'))
            ->assertSessionHasNoErrors();

        $editor->refresh();
        $this->assertSame('Promoted Editor', $editor->name);
        $this->assertSame(['admin'], $editor->getRoleNames()->all());
        $this->assertTrue(Hash::check('LamaSekali123!', $editor->password));
    }

    public function test_super_admin_can_delete_admin_or_editor(): void
    {
        $admin = $this->userWithRole('admin');

        $this->actingAs($this->userWithRole('super_admin'))
            ->delete(route('admin.role-management.destroy', $admin->id))
            ->assertRedirect(route('admin.role-management.index'));

        $this->assertModelMissing($admin);
    }

    public function test_super_admin_accounts_are_protected(): void
    {
        $superAdmin = $this->userWithRole('super_admin');
        $otherSuperAdmin = $this->userWithRole('super_admin');

        foreach ([$superAdmin, $otherSuperAdmin] as $target) {
            $this->actingAs($superAdmin)
                ->get(route('admin.role-management.edit', $target->id))
                ->assertForbidden();

            $this->actingAs($superAdmin)
                ->put(route('admin.role-management.update', $target->id), [
                    'name' => 'Downgraded',
                    'email' => $target->email,
                    'role' => 'editor',
                ])
                ->assertForbidden();

            $this->actingAs($superAdmin)
                ->delete(route('admin.role-management.destroy', $target->id))
                ->assertForbidden();

            $this->assertTrue($target->fresh()->hasRole('super_admin'));
        }
    }
}
