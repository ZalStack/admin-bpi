<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */
        $roles = ['super_admin', 'admin', 'editor'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        $this->command->info('Roles berhasil dibuat: ' . implode(', ', $roles));

        /*
        |--------------------------------------------------------------------------
        | SUPER ADMIN (Tim IT Support)
        |--------------------------------------------------------------------------
        */
        $superAdmin = User::where('email', 'superadmin@bpi.com')->first();
        if (!$superAdmin) {
            $superAdmin = User::create([
                'name' => 'Super Admin BPI',
                'email' => 'superadmin@bpi.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);
        }
        $superAdmin->assignRole('super_admin');
        $this->command->info('Super Admin: superadmin@bpi.com / password123');

        /*
        |--------------------------------------------------------------------------
        | ADMIN (Petinggi Yayasan & Mentor)
        |--------------------------------------------------------------------------
        */
        $admin = User::where('email', 'admin@bpi.com')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin BPI',
                'email' => 'admin@bpi.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);
        }
        $admin->assignRole('admin');
        $this->command->info('Admin: admin@bpi.com / password123');

        /*
        |--------------------------------------------------------------------------
        | EDITOR (Tim Copywriter)
        |--------------------------------------------------------------------------
        */
        $editor = User::where('email', 'editor@bpi.com')->first();
        if (!$editor) {
            $editor = User::create([
                'name' => 'Editor BPI',
                'email' => 'editor@bpi.com',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]);
        }
        $editor->assignRole('editor');
        $this->command->info('Editor: editor@bpi.com / password123');

        /*
        |--------------------------------------------------------------------------
        | SELESAI
        |--------------------------------------------------------------------------
        */
        $this->command->info('==========================================');
        $this->command->info('DATABASE SEEDER BPI BERHASIL DIJALANKAN');
        $this->command->info('==========================================');
        $this->command->info('Super Admin : superadmin@bpi.com / password123');
        $this->command->info('Admin       : admin@bpi.com / password123');
        $this->command->info('Editor      : editor@bpi.com / password123');
        $this->command->info('==========================================');
    }
}
