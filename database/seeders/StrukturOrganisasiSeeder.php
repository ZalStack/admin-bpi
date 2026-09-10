<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StrukturOrganisasiSeeder extends Seeder
{
    public function run(): void
    {
        $jsonPath = __DIR__ . '/data/members.json';
        if (!file_exists($jsonPath)) {
            $jsonPath = __DIR__ . '/data/members.json';
        }
        if (!file_exists($jsonPath)) {
            $this->command->error('members.json not found!');
            return;
        }

        $members = json_decode(file_get_contents($jsonPath), true);

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('struktur_organisasi_translations')->delete();
        DB::table('struktur_organisasi')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $urutan = 1;
        foreach ($members as $m) {
            $fotoName = 'CTq0NtjD4iezz0K1g8P2zabHDm7a87QXDvN6Tlpn.jpg';
            if (!empty($m['imageUrl'])) {
                $fotoName = basename($m['imageUrl']);
            }

            DB::table('struktur_organisasi')->insert([
                'id' => $m['id'],
                'nama' => $m['name'],
                'kategori' => $m['category'],
                'sub_kategori' => $m['subCategory'] ?? null,
                'departemen' => $m['department'] ?? null,
                'level' => $m['level'] ?? 3,
                'foto' => $fotoName,
                'linkedin' => $m['socials']['linkedin'] ?? null,
                'instagram' => $m['socials']['instagram'] ?? null,
                'email' => $m['socials']['email'] ?? null,
                'telepon' => null,
                'urutan' => $urutan,
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('struktur_organisasi_translations')->insert([
                'struktur_organisasi_id' => $m['id'],
                'bahasa' => 'id',
                'jabatan' => $m['role'],
                'departemen' => $m['department'] ?? null,
                'deskripsi' => $m['bio'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('struktur_organisasi_translations')->insert([
                'struktur_organisasi_id' => $m['id'],
                'bahasa' => 'en',
                'jabatan' => $m['roleEn'] ?? $m['role'],
                'departemen' => $m['departmentEn'] ?? $m['department'] ?? null,
                'deskripsi' => $m['bioEn'] ?? $m['bio'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $urutan++;
        }

        $this->command->info("Seeded " . count($members) . " members into struktur_organisasi.");
    }
}
