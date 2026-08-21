<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ApiDocumentationController extends Controller
{
    public function index()
    {
        $modules = collect($this->getModules());

        return view('admin.api-documentation.index', compact('modules'));
    }

    private function getModules(): array
    {
        return [
            [
                'name' => 'Dashboard',
                'prefix' => 'dashboard',
                'color' => '#520A18',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'dashboard/stats', 'desc' => 'Statistik ringkas seluruh konten (total banner, berita, proyek, dll.)'],
                    ['method' => 'GET', 'path' => 'dashboard/recent', 'desc' => 'Daftar aktivitas/konten terbaru untuk dashboard'],
                ],
            ],
            [
                'name' => 'Banner',
                'prefix' => 'banner',
                'color' => '#68001C',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'banner', 'desc' => 'Menampilkan semua data banner'],
                    ['method' => 'POST', 'path' => 'banner', 'desc' => 'Membuat banner baru (upload gambar: gambar)'],
                    ['method' => 'GET', 'path' => 'banner/{id}', 'desc' => 'Detail banner berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'banner/{id}', 'desc' => 'Memperbarui data banner'],
                    ['method' => 'PATCH', 'path' => 'banner/{id}/toggle-status', 'desc' => 'Mengaktifkan / menonaktifkan banner'],
                    ['method' => 'DELETE', 'path' => 'banner/{id}', 'desc' => 'Menghapus banner beserta gambarnya'],
                ],
            ],
            [
                'name' => 'Beranda',
                'prefix' => 'beranda',
                'color' => '#821E38',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'beranda', 'desc' => 'Menampilkan semua konten beranda'],
                    ['method' => 'POST', 'path' => 'beranda', 'desc' => 'Membuat konten beranda baru'],
                    ['method' => 'GET', 'path' => 'beranda/active', 'desc' => 'Konten beranda dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'beranda/update-urutan', 'desc' => 'Update urutan tampil konten beranda'],
                    ['method' => 'GET', 'path' => 'beranda/section/{section}', 'desc' => 'Konten beranda berdasarkan section (hero, about, dll.)'],
                    ['method' => 'GET', 'path' => 'beranda/{id}', 'desc' => 'Detail konten beranda berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'beranda/{id}', 'desc' => 'Memperbarui konten beranda'],
                    ['method' => 'PATCH', 'path' => 'beranda/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan konten beranda'],
                    ['method' => 'DELETE', 'path' => 'beranda/{id}', 'desc' => 'Menghapus konten beranda'],
                ],
            ],
            [
                'name' => 'Tentang',
                'prefix' => 'tentang',
                'color' => '#132C5C',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'tentang', 'desc' => 'Menampilkan semua konten tentang'],
                    ['method' => 'POST', 'path' => 'tentang', 'desc' => 'Membuat konten tentang baru'],
                    ['method' => 'GET', 'path' => 'tentang/active', 'desc' => 'Konten tentang dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'tentang/update-urutan', 'desc' => 'Update urutan tampil konten tentang'],
                    ['method' => 'GET', 'path' => 'tentang/section/{section}', 'desc' => 'Konten tentang berdasarkan section'],
                    ['method' => 'GET', 'path' => 'tentang/{id}', 'desc' => 'Detail konten tentang berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'tentang/{id}', 'desc' => 'Memperbarui konten tentang'],
                    ['method' => 'PATCH', 'path' => 'tentang/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan konten tentang'],
                    ['method' => 'DELETE', 'path' => 'tentang/{id}', 'desc' => 'Menghapus konten tentang'],
                ],
            ],
            [
                'name' => 'Mitra',
                'prefix' => 'mitra',
                'color' => '#2B4E94',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'mitra', 'desc' => 'Menampilkan semua data mitra'],
                    ['method' => 'POST', 'path' => 'mitra', 'desc' => 'Membuat mitra baru (upload logo)'],
                    ['method' => 'GET', 'path' => 'mitra/active', 'desc' => 'Mitra dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'mitra/update-urutan', 'desc' => 'Update urutan tampil mitra'],
                    ['method' => 'GET', 'path' => 'mitra/kategori/{kategori}', 'desc' => 'Mitra berdasarkan kategori'],
                    ['method' => 'GET', 'path' => 'mitra/{id}', 'desc' => 'Detail mitra berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'mitra/{id}', 'desc' => 'Memperbarui data mitra'],
                    ['method' => 'PATCH', 'path' => 'mitra/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan mitra'],
                    ['method' => 'DELETE', 'path' => 'mitra/{id}', 'desc' => 'Menghapus mitra beserta logonya'],
                ],
            ],
            [
                'name' => 'Stakeholder',
                'prefix' => 'stakeholder',
                'color' => '#16336D',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'stakeholder', 'desc' => 'Menampilkan semua data stakeholder'],
                    ['method' => 'POST', 'path' => 'stakeholder', 'desc' => 'Membuat stakeholder baru (upload logo)'],
                    ['method' => 'GET', 'path' => 'stakeholder/active', 'desc' => 'Stakeholder dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'stakeholder/update-urutan', 'desc' => 'Update urutan tampil stakeholder'],
                    ['method' => 'GET', 'path' => 'stakeholder/{id}', 'desc' => 'Detail stakeholder berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'stakeholder/{id}', 'desc' => 'Memperbarui data stakeholder'],
                    ['method' => 'PATCH', 'path' => 'stakeholder/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan stakeholder'],
                    ['method' => 'DELETE', 'path' => 'stakeholder/{id}', 'desc' => 'Menghapus stakeholder beserta logonya'],
                ],
            ],
            [
                'name' => 'Program',
                'prefix' => 'program',
                'color' => '#97763A',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'program', 'desc' => 'Menampilkan semua data program'],
                    ['method' => 'POST', 'path' => 'program', 'desc' => 'Membuat program baru (upload gambar)'],
                    ['method' => 'GET', 'path' => 'program/active', 'desc' => 'Program dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'program/update-urutan', 'desc' => 'Update urutan tampil program'],
                    ['method' => 'GET', 'path' => 'program/{id}', 'desc' => 'Detail program berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'program/{id}', 'desc' => 'Memperbarui data program'],
                    ['method' => 'PATCH', 'path' => 'program/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan program'],
                    ['method' => 'DELETE', 'path' => 'program/{id}', 'desc' => 'Menghapus program beserta gambarnya'],
                ],
            ],
            [
                'name' => 'Proyek',
                'prefix' => 'proyek',
                'color' => '#B09861',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'proyek', 'desc' => 'Menampilkan semua data proyek'],
                    ['method' => 'POST', 'path' => 'proyek', 'desc' => 'Membuat proyek baru (upload thumbnail)'],
                    ['method' => 'GET', 'path' => 'proyek/active', 'desc' => 'Proyek dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'proyek/update-urutan', 'desc' => 'Update urutan tampil proyek'],
                    ['method' => 'GET', 'path' => 'proyek/slug/{slug}', 'desc' => 'Proyek berdasarkan slug'],
                    ['method' => 'GET', 'path' => 'proyek/status/{status}', 'desc' => 'Proyek berdasarkan status (draft/published/archived)'],
                    ['method' => 'GET', 'path' => 'proyek/kategori/{kategori}', 'desc' => 'Proyek berdasarkan kategori'],
                    ['method' => 'GET', 'path' => 'proyek/{id}', 'desc' => 'Detail proyek berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'proyek/{id}', 'desc' => 'Memperbarui data proyek'],
                    ['method' => 'PATCH', 'path' => 'proyek/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan proyek'],
                    ['method' => 'DELETE', 'path' => 'proyek/{id}', 'desc' => 'Menghapus proyek beserta gambarnya'],
                ],
            ],
            [
                'name' => 'Proyek Galeri',
                'prefix' => 'proyek-galeri',
                'color' => '#5876B0',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'proyek-galeri', 'desc' => 'Menampilkan semua galeri proyek'],
                    ['method' => 'POST', 'path' => 'proyek-galeri', 'desc' => 'Menambahkan foto galeri proyek'],
                    ['method' => 'GET', 'path' => 'proyek-galeri/proyek/{proyekId}', 'desc' => 'Galeri berdasarkan ID proyek'],
                    ['method' => 'GET', 'path' => 'proyek-galeri/{id}', 'desc' => 'Detail foto galeri berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'proyek-galeri/{id}', 'desc' => 'Memperbarui foto galeri'],
                    ['method' => 'PATCH', 'path' => 'proyek-galeri/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan foto galeri'],
                    ['method' => 'DELETE', 'path' => 'proyek-galeri/{id}', 'desc' => 'Menghapus foto galeri beserta filenya'],
                ],
            ],
            [
                'name' => 'Berita',
                'prefix' => 'berita',
                'color' => '#A85C66',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'berita', 'desc' => 'Menampilkan semua data berita'],
                    ['method' => 'POST', 'path' => 'berita', 'desc' => 'Membuat berita baru (upload thumbnail)'],
                    ['method' => 'GET', 'path' => 'berita/active', 'desc' => 'Berita dengan status aktif'],
                    ['method' => 'GET', 'path' => 'berita/slug/{slug}', 'desc' => 'Berita berdasarkan slug'],
                    ['method' => 'GET', 'path' => 'berita/status/{status}', 'desc' => 'Berita berdasarkan status (draft/published/archived)'],
                    ['method' => 'GET', 'path' => 'berita/kategori/{kategori}', 'desc' => 'Berita berdasarkan kategori'],
                    ['method' => 'GET', 'path' => 'berita/latest', 'desc' => 'Berita terbaru (limit default 5)'],
                    ['method' => 'GET', 'path' => 'berita/{id}', 'desc' => 'Detail berita berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'berita/{id}', 'desc' => 'Memperbarui data berita'],
                    ['method' => 'PATCH', 'path' => 'berita/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan berita'],
                    ['method' => 'DELETE', 'path' => 'berita/{id}', 'desc' => 'Menghapus berita beserta thumbnailnya'],
                ],
            ],
            [
                'name' => 'Berita Galeri',
                'prefix' => 'berita-galeri',
                'color' => '#CC707C',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'berita-galeri', 'desc' => 'Menampilkan semua galeri berita'],
                    ['method' => 'POST', 'path' => 'berita-galeri', 'desc' => 'Menambahkan foto galeri berita'],
                    ['method' => 'GET', 'path' => 'berita-galeri/berita/{beritaId}', 'desc' => 'Galeri berdasarkan ID berita'],
                    ['method' => 'GET', 'path' => 'berita-galeri/{id}', 'desc' => 'Detail foto galeri berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'berita-galeri/{id}', 'desc' => 'Memperbarui foto galeri'],
                    ['method' => 'PATCH', 'path' => 'berita-galeri/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan foto galeri'],
                    ['method' => 'DELETE', 'path' => 'berita-galeri/{id}', 'desc' => 'Menghapus foto galeri beserta filenya'],
                ],
            ],
            [
                'name' => 'Struktur Organisasi',
                'prefix' => 'struktur',
                'color' => '#8C4254',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'struktur', 'desc' => 'Menampilkan semua struktur organisasi'],
                    ['method' => 'POST', 'path' => 'struktur', 'desc' => 'Membuat struktur organisasi baru (upload foto)'],
                    ['method' => 'GET', 'path' => 'struktur/active', 'desc' => 'Struktur organisasi dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'struktur/update-urutan', 'desc' => 'Update urutan tampil struktur'],
                    ['method' => 'GET', 'path' => 'struktur/{id}', 'desc' => 'Detail struktur organisasi berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'struktur/{id}', 'desc' => 'Memperbarui data struktur organisasi'],
                    ['method' => 'PATCH', 'path' => 'struktur/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan struktur'],
                    ['method' => 'DELETE', 'path' => 'struktur/{id}', 'desc' => 'Menghapus struktur organisasi beserta fotonya'],
                ],
            ],
            [
                'name' => 'Kontak',
                'prefix' => 'kontak',
                'color' => '#520A18',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'kontak', 'desc' => 'Menampilkan semua data kontak'],
                    ['method' => 'POST', 'path' => 'kontak', 'desc' => 'Membuat data kontak baru'],
                    ['method' => 'GET', 'path' => 'kontak/active', 'desc' => 'Data kontak dengan status aktif'],
                    ['method' => 'GET', 'path' => 'kontak/{id}', 'desc' => 'Detail kontak berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'kontak/{id}', 'desc' => 'Memperbarui data kontak'],
                    ['method' => 'PATCH', 'path' => 'kontak/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan kontak'],
                    ['method' => 'DELETE', 'path' => 'kontak/{id}', 'desc' => 'Menghapus data kontak'],
                ],
            ],
            [
                'name' => 'Pesan Kontak (Kontak Form)',
                'prefix' => 'kontak-form',
                'color' => '#132C5C',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'kontak-form', 'desc' => 'Menampilkan semua pesan masuk'],
                    ['method' => 'POST', 'path' => 'kontak-form', 'desc' => 'Mengirim pesan kontak baru (public form)'],
                    ['method' => 'GET', 'path' => 'kontak-form/unread', 'desc' => 'Pesan yang belum dibaca'],
                    ['method' => 'GET', 'path' => 'kontak-form/status/{status}', 'desc' => 'Pesan berdasarkan status (new/read/replied/spam)'],
                    ['method' => 'GET', 'path' => 'kontak-form/{id}', 'desc' => 'Detail pesan berdasarkan ID'],
                    ['method' => 'PATCH', 'path' => 'kontak-form/{id}/status', 'desc' => 'Update status pesan (body: status)'],
                    ['method' => 'PATCH', 'path' => 'kontak-form/{id}/mark-read', 'desc' => 'Tandai pesan sebagai sudah dibaca'],
                    ['method' => 'PATCH', 'path' => 'kontak-form/{id}/mark-unread', 'desc' => 'Tandai pesan sebagai belum dibaca'],
                    ['method' => 'DELETE', 'path' => 'kontak-form/{id}', 'desc' => 'Menghapus pesan kontak'],
                ],
            ],
            [
                'name' => 'Menu',
                'prefix' => 'menu',
                'color' => '#97763A',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'menu', 'desc' => 'Menampilkan semua menu navigasi'],
                    ['method' => 'POST', 'path' => 'menu', 'desc' => 'Membuat menu navigasi baru'],
                    ['method' => 'GET', 'path' => 'menu/active', 'desc' => 'Menu dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'menu/update-urutan', 'desc' => 'Update urutan tampil menu'],
                    ['method' => 'GET', 'path' => 'menu/slug/{slug}', 'desc' => 'Menu berdasarkan slug'],
                    ['method' => 'GET', 'path' => 'menu/{id}', 'desc' => 'Detail menu berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'menu/{id}', 'desc' => 'Memperbarui data menu'],
                    ['method' => 'PATCH', 'path' => 'menu/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan menu'],
                    ['method' => 'DELETE', 'path' => 'menu/{id}', 'desc' => 'Menghapus menu navigasi'],
                ],
            ],
            [
                'name' => 'Footer',
                'prefix' => 'footer',
                'color' => '#2B4E94',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'footer', 'desc' => 'Menampilkan semua link footer'],
                    ['method' => 'POST', 'path' => 'footer', 'desc' => 'Membuat link footer baru'],
                    ['method' => 'GET', 'path' => 'footer/active', 'desc' => 'Link footer dengan status aktif'],
                    ['method' => 'PUT', 'path' => 'footer/update-urutan', 'desc' => 'Update urutan tampil footer'],
                    ['method' => 'GET', 'path' => 'footer/section/{section}', 'desc' => 'Footer berdasarkan section'],
                    ['method' => 'GET', 'path' => 'footer/{id}', 'desc' => 'Detail footer berdasarkan ID'],
                    ['method' => 'PUT', 'path' => 'footer/{id}', 'desc' => 'Memperbarui data footer'],
                    ['method' => 'PATCH', 'path' => 'footer/{id}/toggle-status', 'desc' => 'Aktif / nonaktifkan footer'],
                    ['method' => 'DELETE', 'path' => 'footer/{id}', 'desc' => 'Menghapus link footer'],
                ],
            ],
            [
                'name' => 'Bahasa / Language',
                'prefix' => 'bahasa',
                'color' => '#A85C66',
                'endpoints' => [
                    ['method' => 'GET', 'path' => 'bahasa/settings', 'desc' => 'Mengambil pengaturan bahasa saat ini'],
                    ['method' => 'PUT', 'path' => 'bahasa/settings', 'desc' => 'Memperbarui pengaturan bahasa'],
                    ['method' => 'POST', 'path' => 'bahasa/switch/{locale}', 'desc' => 'Ganti bahasa aktif (id / en)'],
                    ['method' => 'GET', 'path' => 'bahasa/available', 'desc' => 'Daftar bahasa yang tersedia'],
                ],
            ],
        ];
    }
}
