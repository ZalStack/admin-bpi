<?php

use App\Http\Controllers\Admin\ApiDocumentationController;
use App\Http\Controllers\Admin\BahasaController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\BeritaGaleriController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\KontakFormController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MitraController;
use App\Http\Controllers\Admin\MitraIntroController;
use App\Http\Controllers\Admin\KategoriBeritaController;
use App\Http\Controllers\Admin\KategoriMitraController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ProgramRoadmapController;
use App\Http\Controllers\Admin\ProyekController;
use App\Http\Controllers\Admin\ProyekGaleriController;
use App\Http\Controllers\Admin\StakeholderController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TentangController;
use App\Http\Controllers\Admin\TentangPoinController;
use App\Http\Controllers\Admin\ProgramPoinController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
});

// Auth routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Language switcher
    Route::get('/switch-lang/{locale}', [BahasaController::class, 'switchLang'])->name('switch.lang');

    // =========================================================================
    // Super Admin & Admin routes (semua content management kecuali berita)
    // =========================================================================
    Route::middleware('role:super_admin|admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Banner
            Route::resource('banner', BannerController::class);
            Route::post('/banner/{id}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banner.toggle-status');

            // Beranda
            Route::resource('beranda', BerandaController::class);
            Route::post('/beranda/{id}/toggle-status', [BerandaController::class, 'toggleStatus'])->name('beranda.toggle-status');

            // Stakeholder
            Route::resource('stakeholder', StakeholderController::class);
            Route::post('/stakeholder/{id}/toggle-status', [StakeholderController::class, 'toggleStatus'])->name('stakeholder.toggle-status');

            // Program
            Route::resource('program', ProgramController::class);
            Route::post('/program/{id}/toggle-status', [ProgramController::class, 'toggleStatus'])->name('program.toggle-status');

            // Program Roadmap
            Route::resource('program-roadmap', ProgramRoadmapController::class);
            Route::post('/program-roadmap/{id}/toggle-status', [ProgramRoadmapController::class, 'toggleStatus'])->name('program-roadmap.toggle-status');

            // Program Poin
            Route::resource('program-poin', ProgramPoinController::class);
            Route::post('/program-poin/{id}/toggle-status', [ProgramPoinController::class, 'toggleStatus'])->name('program-poin.toggle-status');

            // Proyek
            Route::resource('proyek', ProyekController::class);
            Route::post('/proyek/{id}/toggle-status', [ProyekController::class, 'toggleStatus'])->name('proyek.toggle-status');

            // Proyek Galeri
            Route::prefix('proyek/{proyek_id}/galeri')
                ->name('proyek.galeri.')
                ->group(function () {
                    Route::get('/', [ProyekGaleriController::class, 'index'])->name('index');
                    Route::get('/create', [ProyekGaleriController::class, 'create'])->name('create');
                    Route::post('/', [ProyekGaleriController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [ProyekGaleriController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [ProyekGaleriController::class, 'update'])->name('update');
                    Route::delete('/{id}', [ProyekGaleriController::class, 'destroy'])->name('destroy');
                    Route::post('/{id}/toggle-status', [ProyekGaleriController::class, 'toggleStatus'])->name('toggle-status');
                });

            // Mitra
            Route::resource('mitra', MitraController::class);
            Route::post('/mitra/{id}/toggle-status', [MitraController::class, 'toggleStatus'])->name('mitra.toggle-status');

            // Kategori Mitra
            Route::resource('kategori-mitra', KategoriMitraController::class);
            Route::post('/kategori-mitra/{id}/toggle-status', [KategoriMitraController::class, 'toggleStatus'])->name('kategori-mitra.toggle-status');

            // Mitra Intro
            Route::resource('mitra-intro', MitraIntroController::class);

            // Tentang
            Route::resource('tentang', TentangController::class);
            Route::post('/tentang/{id}/toggle-status', [TentangController::class, 'toggleStatus'])->name('tentang.toggle-status');

            // Tentang Poin
            Route::resource('tentang-poin', TentangPoinController::class);
            Route::post('/tentang-poin/{id}/toggle-status', [TentangPoinController::class, 'toggleStatus'])->name('tentang-poin.toggle-status');

            // Struktur Organisasi
            Route::resource('struktur', StrukturOrganisasiController::class);
            Route::post('/struktur/{id}/toggle-status', [StrukturOrganisasiController::class, 'toggleStatus'])->name('struktur.toggle-status');

            // Kontak
            Route::resource('kontak', KontakController::class);
            Route::post('/kontak/{id}/toggle-status', [KontakController::class, 'toggleStatus'])->name('kontak.toggle-status');

            // Kontak Form
            Route::get('kontak-form', [KontakFormController::class, 'index'])->name('kontak-form.index');
            Route::get('kontak-form/{id}', [KontakFormController::class, 'show'])->name('kontak-form.show');
            Route::delete('kontak-form/{id}', [KontakFormController::class, 'destroy'])->name('kontak-form.destroy');
            Route::post('kontak-form/{id}/status/{status}', [KontakFormController::class, 'updateStatus'])->name('kontak-form.update-status');

            // Menu
            Route::resource('menu', MenuController::class);
            Route::post('/menu/{id}/toggle-status', [MenuController::class, 'toggleStatus'])->name('menu.toggle-status');

            // Footer
            Route::resource('footer', FooterController::class);
            Route::post('/footer/{id}/toggle-status', [FooterController::class, 'toggleStatus'])->name('footer.toggle-status');

            // Bahasa
            Route::get('bahasa', [BahasaController::class, 'index'])->name('bahasa.index');
            Route::post('bahasa', [BahasaController::class, 'store'])->name('bahasa.store');
            Route::put('bahasa/{kode}', [BahasaController::class, 'update'])->name('bahasa.update');
            Route::patch('bahasa/{kode}/set-default', [BahasaController::class, 'setDefault'])->name('bahasa.set-default');
            Route::patch('bahasa/{kode}/toggle-status', [BahasaController::class, 'toggleStatus'])->name('bahasa.toggle-status');
            Route::delete('bahasa/{kode}', [BahasaController::class, 'destroy'])->name('bahasa.destroy');
        });

    // =========================================================================
    // Berita routes — Super Admin, Admin & Editor
    // =========================================================================
    Route::middleware('role:super_admin|admin|editor')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Berita
            Route::resource('berita', BeritaController::class);
            Route::post('/berita/{id}/toggle-status', [BeritaController::class, 'toggleStatus'])->name('berita.toggle-status');

            // Kategori Berita
            Route::resource('kategori-berita', KategoriBeritaController::class);

            // Berita Galeri
            Route::prefix('berita/{berita_id}/galeri')
                ->name('berita.galeri.')
                ->group(function () {
                    Route::get('/', [BeritaGaleriController::class, 'index'])->name('index');
                    Route::get('/create', [BeritaGaleriController::class, 'create'])->name('create');
                    Route::post('/', [BeritaGaleriController::class, 'store'])->name('store');
                    Route::get('/{id}/edit', [BeritaGaleriController::class, 'edit'])->name('edit');
                    Route::put('/{id}', [BeritaGaleriController::class, 'update'])->name('update');
                    Route::delete('/{id}', [BeritaGaleriController::class, 'destroy'])->name('destroy');
                    Route::post('/{id}/toggle-status', [BeritaGaleriController::class, 'toggleStatus'])->name('toggle-status');
                });

            // Tag
            Route::resource('tag', TagController::class);
            Route::post('/tag/{id}/toggle-status', [TagController::class, 'toggleStatus'])->name('tag.toggle-status');
        });

    // =========================================================================
    // Super Admin only routes
    // =========================================================================
    Route::middleware('role:super_admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // API Documentation
            Route::get('api-documentation', [ApiDocumentationController::class, 'index'])
                ->name('api-documentation.index');

            // Maintenance routes
            Route::get('maintenance/storage-link', function () {
                try {
                    \Illuminate\Support\Facades\Artisan::call('storage:link');
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Symlink storage berhasil dibuat: ' . \Illuminate\Support\Facades\Artisan::output()
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ], 500);
                }
            })->name('maintenance.storage-link');

            Route::get('maintenance/clear-cache', function () {
                try {
                    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Cache aplikasi berhasil dibersihkan: ' . \Illuminate\Support\Facades\Artisan::output()
                    ]);
                } catch (\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ], 500);
                }
            })->name('maintenance.clear-cache');
        });
});

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});
