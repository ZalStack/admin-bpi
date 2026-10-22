<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * Kelola akun CMS beserta role-nya (khusus super admin).
 * Role super_admin tidak bisa diberikan, diubah, atau dihapus dari sini
 * (hanya lewat seeder/database) agar akses tertinggi tidak bisa bocor.
 */
class RoleManagementController extends Controller
{
    /** Role yang boleh diberikan lewat menu ini => label tampilan. */
    public const MANAGEABLE_ROLES = [
        'admin' => 'Admin',
        'editor' => 'Editor',
    ];

    public const ROLE_LABELS = ['super_admin' => 'Super Admin'] + self::MANAGEABLE_ROLES;

    protected string $viewPrefix = 'admin.role-management';

    protected string $routeName = 'admin.role-management';

    public function index()
    {
        $items = User::query()->with('roles')->orderBy('name')->get();

        $roleCounts = collect(self::ROLE_LABELS)
            ->map(fn ($label, $role) => $items->filter(fn (User $user) => $user->hasRole($role))->count());

        return view($this->viewPrefix.'.index', [
            'items' => $items,
            'roleCounts' => $roleCounts,
            'roleLabels' => self::ROLE_LABELS,
        ]);
    }

    public function create()
    {
        return view($this->viewPrefix.'.create', [
            'roles' => self::MANAGEABLE_ROLES,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateUser($request);

        $user = new User([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        // Akun dibuat super admin, jadi dianggap sudah terverifikasi.
        $user->forceFill(['email_verified_at' => now()])->save();
        $user->syncRoles([$validated['role']]);

        return redirect()->route($this->routeName.'.index')
            ->with('success', "User \"{$user->name}\" added as ".self::MANAGEABLE_ROLES[$validated['role']]);
    }

    public function edit($id)
    {
        $item = $this->findManageable($id);

        return view($this->viewPrefix.'.edit', [
            'item' => $item,
            'roles' => self::MANAGEABLE_ROLES,
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = $this->findManageable($id);

        $validated = $this->validateUser($request, $item);

        $item->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Password kosong saat edit = tidak diubah.
        if (! empty($validated['password'])) {
            $item->password = $validated['password'];
        }

        $item->save();
        $item->syncRoles([$validated['role']]);

        return redirect()->route($this->routeName.'.index')
            ->with('success', "User \"{$item->name}\" updated successfully");
    }

    public function destroy($id)
    {
        $item = $this->findManageable($id);

        $item->delete();

        return redirect()->route($this->routeName.'.index')
            ->with('success', "User \"{$item->name}\" deleted successfully");
    }

    /**
     * Akun super admin (termasuk akun sendiri) tidak boleh dikelola dari menu ini.
     */
    protected function findManageable($id): User
    {
        $user = User::query()->findOrFail($id);

        abort_if($user->hasRole('super_admin'), 403, 'Super admin accounts cannot be managed from this menu.');

        return $user;
    }

    protected function validateUser(Request $request, ?User $item = null): array
    {
        $request->merge(['email' => strtolower(trim((string) $request->input('email')))]);

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($item?->id),
            ],
            'role' => ['required', 'string', Rule::in(array_keys(self::MANAGEABLE_ROLES))],
            'password' => [$item ? 'nullable' : 'required', Password::defaults(), 'confirmed'],
        ], [
            'role.in' => 'The selected role is not allowed. Only Admin or Editor can be assigned.',
            'email.unique' => 'This email is already used by another account.',
        ]);
    }
}
