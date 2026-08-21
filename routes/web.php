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
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\ProyekController;
use App\Http\Controllers\Admin\ProyekGaleriController;
use App\Http\Controllers\Admin\StakeholderController;
use App\Http\Controllers\Admin\StrukturOrganisasiController;
use App\Http\Controllers\Admin\TentangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
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

    // Admin routes
    Route::prefix('admin')
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

            // Berita
            Route::resource('berita', BeritaController::class);
            Route::post('/berita/{id}/toggle-status', [BeritaController::class, 'toggleStatus'])->name('berita.toggle-status');

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

            // Tentang
            Route::resource('tentang', TentangController::class);
            Route::post('/tentang/{id}/toggle-status', [TentangController::class, 'toggleStatus'])->name('tentang.toggle-status');

            // Bahasa
            Route::get('bahasa', [BahasaController::class, 'index'])->name('bahasa.index');
            Route::put('bahasa', [BahasaController::class, 'update'])->name('bahasa.update');

            // Tambahkan di dalam group admin routes
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
        });

});

// Public routes (no auth required)
Route::get('/admin/api-documentation', [ApiDocumentationController::class, 'index'])
    ->name('admin.api-documentation.index');

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});
