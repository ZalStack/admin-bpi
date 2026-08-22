<?php

namespace Database\Seeders;

use App\Models\Bahasa;
use Illuminate\Database\Seeder;

class BahasaSeeder extends Seeder
{
    /**
     * Seed bahasa default.
     * Menambah bahasa baru di masa depan cukup insert data di sini
     * atau lewat endpoint POST /api/admin/v1/bahasa — tanpa perubahan kode.
     */
    public function run(): void
    {
        $bahasas = [
            ['kode' => 'id', 'nama' => 'Indonesia', 'aktif' => true, 'is_default' => true],
            ['kode' => 'en', 'nama' => 'English', 'aktif' => true, 'is_default' => false],
            ['kode' => 'jp', 'nama' => 'Japan', 'aktif' => false, 'is_default' => false],
        ];

        foreach ($bahasas as $bahasa) {
            Bahasa::updateOrCreate(
                ['kode' => $bahasa['kode']],
                $bahasa
            );
        }
    }
}
