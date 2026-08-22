<?php

use App\Http\Controllers\Api\Admin\BahasaApiController;
use App\Http\Controllers\Api\Admin\BannerApiController;
use App\Http\Controllers\Api\Admin\BerandaApiController;
use App\Http\Controllers\Api\Admin\BeritaApiController;
use App\Http\Controllers\Api\Admin\BeritaGaleriApiController;
use App\Http\Controllers\Api\Admin\DashboardApiController;
use App\Http\Controllers\Api\Admin\FooterApiController;
use App\Http\Controllers\Api\Admin\KontakApiController;
use App\Http\Controllers\Api\Admin\KontakFormApiController;
use App\Http\Controllers\Api\Admin\KontakDetailApiController;
use App\Http\Controllers\Api\Admin\MenuApiController;
use App\Http\Controllers\Api\Admin\MitraApiController;
use App\Http\Controllers\Api\Admin\ProgramApiController;
use App\Http\Controllers\Api\Admin\ProgramPoinApiController;
use App\Http\Controllers\Api\Admin\ProyekApiController;
use App\Http\Controllers\Api\Admin\ProyekGaleriApiController;
use App\Http\Controllers\Api\Admin\StakeholderApiController;
use App\Http\Controllers\Api\Admin\StrukturOrganisasiApiController;
use App\Http\Controllers\Api\Admin\TentangApiController;
use App\Http\Controllers\Api\Admin\TentangPoinApiController;
use App\Http\Controllers\Api\Admin\TagApiController;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes - Admin Panel BPI
|--------------------------------------------------------------------------
|
| Base URL: http://localhost:8000/api/admin/v1/
|
| GET  : publik (throttle 120 req/menit per IP) untuk konsumsi frontend.
| POST / PUT / PATCH / DELETE : wajib login admin (session).
| Pengecualian: POST kontak-form tetap publik (form kontak situs),
| dilindungi honeypot + throttle ketat.
|
*/

Route::prefix('admin/v1')
    ->middleware([
        'throttle:api-read',
        EncryptCookies::class,
        StartSession::class,
        'mutation.auth',
    ])
    ->group(function () {

        // ============================================
        // DASHBOARD
        // ============================================
        Route::prefix('dashboard')->group(function () {
            Route::get('/stats', [DashboardApiController::class, 'stats']);
            Route::get('/recent', [DashboardApiController::class, 'recent']);
        });

        // ============================================
        // BANNER
        // ============================================
        Route::prefix('banner')->group(function () {
            Route::get('/', [BannerApiController::class, 'index']);
            Route::post('/', [BannerApiController::class, 'store']);
            Route::patch('/{id}/toggle-status', [BannerApiController::class, 'toggleStatus']);
            Route::get('/{id}', [BannerApiController::class, 'show']);
            Route::put('/{id}', [BannerApiController::class, 'update']);
            Route::delete('/{id}', [BannerApiController::class, 'destroy']);
        });

        // ============================================
        // BERANDA
        // ============================================
        Route::prefix('beranda')->group(function () {
            Route::get('/', [BerandaApiController::class, 'index']);
            Route::post('/', [BerandaApiController::class, 'store']);
            Route::get('/active', [BerandaApiController::class, 'getActive']);
            Route::put('/update-urutan', [BerandaApiController::class, 'updateUrutan']);
            Route::get('/section/{section}', [BerandaApiController::class, 'getBySection']);
            Route::patch('/{id}/toggle-status', [BerandaApiController::class, 'toggleStatus']);
            Route::get('/{id}', [BerandaApiController::class, 'show']);
            Route::put('/{id}', [BerandaApiController::class, 'update']);
            Route::delete('/{id}', [BerandaApiController::class, 'destroy']);
        });

        // ============================================
        // TENTANG
        // ============================================
        Route::prefix('tentang')->group(function () {
            Route::get('/', [TentangApiController::class, 'index']);
            Route::post('/', [TentangApiController::class, 'store']);
            Route::get('/active', [TentangApiController::class, 'getActive']);
            Route::put('/update-urutan', [TentangApiController::class, 'updateUrutan']);
            Route::get('/section/{section}', [TentangApiController::class, 'getBySection']);
            Route::patch('/{id}/toggle-status', [TentangApiController::class, 'toggleStatus']);
            Route::get('/{id}', [TentangApiController::class, 'show']);
            Route::put('/{id}', [TentangApiController::class, 'update']);
            Route::delete('/{id}', [TentangApiController::class, 'destroy']);
        });

        // ============================================
        // TENTANG POIN
        // ============================================
        Route::prefix('tentang-poin')->group(function () {
            Route::get('/', [TentangPoinApiController::class, 'index']);
            Route::post('/', [TentangPoinApiController::class, 'store']);
            Route::get('/tentang/{tentangId}', [TentangPoinApiController::class, 'getByTentang']);
            Route::patch('/{id}/toggle-status', [TentangPoinApiController::class, 'toggleStatus']);
            Route::get('/{id}', [TentangPoinApiController::class, 'show']);
            Route::put('/{id}', [TentangPoinApiController::class, 'update']);
            Route::delete('/{id}', [TentangPoinApiController::class, 'destroy']);
        });

        // ============================================
        // MITRA
        // ============================================
        Route::prefix('mitra')->group(function () {
            Route::get('/', [MitraApiController::class, 'index']);
            Route::post('/', [MitraApiController::class, 'store']);
            Route::get('/active', [MitraApiController::class, 'getActive']);
            Route::put('/update-urutan', [MitraApiController::class, 'updateUrutan']);
            Route::get('/kategori/{kategori}', [MitraApiController::class, 'getByKategori']);
            Route::patch('/{id}/toggle-status', [MitraApiController::class, 'toggleStatus']);
            Route::get('/{id}', [MitraApiController::class, 'show']);
            Route::put('/{id}', [MitraApiController::class, 'update']);
            Route::delete('/{id}', [MitraApiController::class, 'destroy']);
        });

        // ============================================
        // STAKEHOLDER
        // ============================================
        Route::prefix('stakeholder')->group(function () {
            Route::get('/', [StakeholderApiController::class, 'index']);
            Route::post('/', [StakeholderApiController::class, 'store']);
            Route::get('/active', [StakeholderApiController::class, 'getActive']);
            Route::put('/update-urutan', [StakeholderApiController::class, 'updateUrutan']);
            Route::patch('/{id}/toggle-status', [StakeholderApiController::class, 'toggleStatus']);
            Route::get('/{id}', [StakeholderApiController::class, 'show']);
            Route::put('/{id}', [StakeholderApiController::class, 'update']);
            Route::delete('/{id}', [StakeholderApiController::class, 'destroy']);
        });

        // ============================================
        // PROGRAM
        // ============================================
        Route::prefix('program')->group(function () {
            Route::get('/', [ProgramApiController::class, 'index']);
            Route::post('/', [ProgramApiController::class, 'store']);
            Route::get('/active', [ProgramApiController::class, 'getActive']);
            Route::put('/update-urutan', [ProgramApiController::class, 'updateUrutan']);
            Route::patch('/{id}/toggle-status', [ProgramApiController::class, 'toggleStatus']);
            Route::get('/{id}', [ProgramApiController::class, 'show']);
            Route::put('/{id}', [ProgramApiController::class, 'update']);
            Route::delete('/{id}', [ProgramApiController::class, 'destroy']);
        });

        // ============================================
        // PROGRAM POIN
        // ============================================
        Route::prefix('program-poin')->group(function () {
            Route::get('/', [ProgramPoinApiController::class, 'index']);
            Route::post('/', [ProgramPoinApiController::class, 'store']);
            Route::get('/program/{programId}', [ProgramPoinApiController::class, 'getByProgram']);
            Route::patch('/{id}/toggle-status', [ProgramPoinApiController::class, 'toggleStatus']);
            Route::get('/{id}', [ProgramPoinApiController::class, 'show']);
            Route::put('/{id}', [ProgramPoinApiController::class, 'update']);
            Route::delete('/{id}', [ProgramPoinApiController::class, 'destroy']);
        });

        // ============================================
        // PROYEK
        // ============================================
        Route::prefix('proyek')->group(function () {
            Route::get('/', [ProyekApiController::class, 'index']);
            Route::post('/', [ProyekApiController::class, 'store']);
            Route::get('/active', [ProyekApiController::class, 'getActive']);
            Route::put('/update-urutan', [ProyekApiController::class, 'updateUrutan']);
            Route::get('/slug/{slug}', [ProyekApiController::class, 'getBySlug']);
            Route::get('/status/{status}', [ProyekApiController::class, 'getByStatus']);
            Route::get('/kategori/{kategori}', [ProyekApiController::class, 'getByKategori']);
            Route::patch('/{id}/toggle-status', [ProyekApiController::class, 'toggleStatus']);
            Route::get('/{id}', [ProyekApiController::class, 'show']);
            Route::put('/{id}', [ProyekApiController::class, 'update']);
            Route::delete('/{id}', [ProyekApiController::class, 'destroy']);
        });

        // ============================================
        // PROYEK GALERI
        // ============================================
        Route::prefix('proyek-galeri')->group(function () {
            Route::get('/', [ProyekGaleriApiController::class, 'index']);
            Route::post('/', [ProyekGaleriApiController::class, 'store']);
            Route::get('/proyek/{proyekId}', [ProyekGaleriApiController::class, 'getByProyek']);
            Route::patch('/{id}/toggle-status', [ProyekGaleriApiController::class, 'toggleStatus']);
            Route::get('/{id}', [ProyekGaleriApiController::class, 'show']);
            Route::put('/{id}', [ProyekGaleriApiController::class, 'update']);
            Route::delete('/{id}', [ProyekGaleriApiController::class, 'destroy']);
        });

        // ============================================
        // BERITA
        // ============================================
        Route::prefix('berita')->group(function () {
            Route::get('/', [BeritaApiController::class, 'index']);
            Route::post('/', [BeritaApiController::class, 'store']);
            Route::get('/active', [BeritaApiController::class, 'getActive']);
            Route::get('/kategori', [BeritaApiController::class, 'getKategori']);
            Route::get('/slug/{slug}', [BeritaApiController::class, 'getBySlug']);
            Route::get('/status/{status}', [BeritaApiController::class, 'getByStatus']);
            Route::get('/kategori/{kategori}', [BeritaApiController::class, 'getByKategori']);
            Route::get('/latest', [BeritaApiController::class, 'getLatest']);
            Route::patch('/{id}/toggle-status', [BeritaApiController::class, 'toggleStatus']);
            Route::get('/{id}', [BeritaApiController::class, 'show']);
            Route::put('/{id}', [BeritaApiController::class, 'update']);
            Route::delete('/{id}', [BeritaApiController::class, 'destroy']);
        });

        // ============================================
        // TAGS
        // ============================================
        Route::prefix('tag')->group(function () {
            Route::get('/', [TagApiController::class, 'index']);
            Route::post('/', [TagApiController::class, 'store']);
            Route::patch('/{id}/toggle-status', [TagApiController::class, 'toggleStatus']);
            Route::get('/{id}', [TagApiController::class, 'show']);
            Route::put('/{id}', [TagApiController::class, 'update']);
            Route::delete('/{id}', [TagApiController::class, 'destroy']);
        });

        // ============================================
        // BERITA GALERI
        // ============================================
        Route::prefix('berita-galeri')->group(function () {
            Route::get('/', [BeritaGaleriApiController::class, 'index']);
            Route::post('/', [BeritaGaleriApiController::class, 'store']);
            Route::get('/berita/{beritaId}', [BeritaGaleriApiController::class, 'getByBerita']);
            Route::patch('/{id}/toggle-status', [BeritaGaleriApiController::class, 'toggleStatus']);
            Route::get('/{id}', [BeritaGaleriApiController::class, 'show']);
            Route::put('/{id}', [BeritaGaleriApiController::class, 'update']);
            Route::delete('/{id}', [BeritaGaleriApiController::class, 'destroy']);
        });

        // ============================================
        // STRUKTUR ORGANISASI
        // ============================================
        Route::prefix('struktur')->group(function () {
            Route::get('/', [StrukturOrganisasiApiController::class, 'index']);
            Route::post('/', [StrukturOrganisasiApiController::class, 'store']);
            Route::get('/active', [StrukturOrganisasiApiController::class, 'getActive']);
            Route::put('/update-urutan', [StrukturOrganisasiApiController::class, 'updateUrutan']);
            Route::patch('/{id}/toggle-status', [StrukturOrganisasiApiController::class, 'toggleStatus']);
            Route::get('/{id}', [StrukturOrganisasiApiController::class, 'show']);
            Route::put('/{id}', [StrukturOrganisasiApiController::class, 'update']);
            Route::delete('/{id}', [StrukturOrganisasiApiController::class, 'destroy']);
        });

        // ============================================
        // KONTAK
        // ============================================
        Route::prefix('kontak')->group(function () {
            Route::get('/', [KontakApiController::class, 'index']);
            Route::post('/', [KontakApiController::class, 'store']);
            Route::get('/active', [KontakApiController::class, 'getActive']);
            Route::patch('/{id}/toggle-status', [KontakApiController::class, 'toggleStatus']);
            Route::get('/{id}', [KontakApiController::class, 'show']);
            Route::put('/{id}', [KontakApiController::class, 'update']);
            Route::delete('/{id}', [KontakApiController::class, 'destroy']);
        });

        // ============================================
        // KONTAK DETAIL
        // ============================================
        Route::prefix('kontak-detail')->group(function () {
            Route::get('/', [KontakDetailApiController::class, 'index']);
            Route::post('/', [KontakDetailApiController::class, 'store']);
            Route::get('/kontak/{kontakId}', [KontakDetailApiController::class, 'getByKontak']);
            Route::patch('/{id}/toggle-status', [KontakDetailApiController::class, 'toggleStatus']);
            Route::get('/{id}', [KontakDetailApiController::class, 'show']);
            Route::put('/{id}', [KontakDetailApiController::class, 'update']);
            Route::delete('/{id}', [KontakDetailApiController::class, 'destroy']);
        });

        // ============================================
        // KONTAK FORM
        // ============================================
        Route::prefix('kontak-form')->group(function () {
            Route::get('/', [KontakFormApiController::class, 'index']);
            Route::post('/', [KontakFormApiController::class, 'store'])->middleware('throttle:kontak-form');
            Route::get('/unread', [KontakFormApiController::class, 'getUnread']);
            Route::get('/status/{status}', [KontakFormApiController::class, 'getByStatus']);
            Route::patch('/{id}/status', [KontakFormApiController::class, 'updateStatus']);
            Route::patch('/{id}/mark-read', [KontakFormApiController::class, 'markAsRead']);
            Route::patch('/{id}/mark-unread', [KontakFormApiController::class, 'markAsUnread']);
            Route::get('/{id}', [KontakFormApiController::class, 'show']);
            Route::delete('/{id}', [KontakFormApiController::class, 'destroy']);
        });

        // ============================================
        // MENU
        // ============================================
        Route::prefix('menu')->group(function () {
            Route::get('/', [MenuApiController::class, 'index']);
            Route::post('/', [MenuApiController::class, 'store']);
            Route::get('/active', [MenuApiController::class, 'getActive']);
            Route::put('/update-urutan', [MenuApiController::class, 'updateUrutan']);
            Route::get('/slug/{slug}', [MenuApiController::class, 'getBySlug']);
            Route::patch('/{id}/toggle-status', [MenuApiController::class, 'toggleStatus']);
            Route::get('/{id}', [MenuApiController::class, 'show']);
            Route::put('/{id}', [MenuApiController::class, 'update']);
            Route::delete('/{id}', [MenuApiController::class, 'destroy']);
        });

        // ============================================
        // FOOTER
        // ============================================
        Route::prefix('footer')->group(function () {
            Route::get('/', [FooterApiController::class, 'index']);
            Route::post('/', [FooterApiController::class, 'store']);
            Route::get('/active', [FooterApiController::class, 'getActive']);
            Route::put('/update-urutan', [FooterApiController::class, 'updateUrutan']);
            Route::get('/section/{section}', [FooterApiController::class, 'getBySection']);
            Route::patch('/{id}/toggle-status', [FooterApiController::class, 'toggleStatus']);
            Route::get('/{id}', [FooterApiController::class, 'show']);
            Route::put('/{id}', [FooterApiController::class, 'update']);
            Route::delete('/{id}', [FooterApiController::class, 'destroy']);
        });

        // ============================================
        // BAHASA / LANGUAGE (master data)
        // Menambah bahasa baru cukup POST ke endpoint ini,
        // semua tabel konten otomatis mendukung bahasa tersebut.
        // ============================================
        Route::prefix('bahasa')->group(function () {
            Route::get('/', [BahasaApiController::class, 'index']);
            Route::post('/', [BahasaApiController::class, 'store']);
            Route::get('/settings', [BahasaApiController::class, 'getSettings']);
            Route::get('/available', [BahasaApiController::class, 'getAvailableLanguages']);
            Route::post('/switch/{locale}', [BahasaApiController::class, 'switchLanguage']);
            Route::patch('/{kode}/set-default', [BahasaApiController::class, 'setDefault']);
            Route::patch('/{kode}/toggle-status', [BahasaApiController::class, 'toggleStatus']);
            Route::get('/{kode}', [BahasaApiController::class, 'show']);
            Route::put('/{kode}', [BahasaApiController::class, 'update']);
            Route::delete('/{kode}', [BahasaApiController::class, 'destroy']);
        });

    });
