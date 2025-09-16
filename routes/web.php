<?php

        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\AuthController;
        use App\Http\Controllers\AdminDashboardController;
        use App\Http\Controllers\PlnOfficeController;
        use App\Http\Controllers\UserOfficeController;
        use App\Http\Controllers\GedungController;
        use App\Http\Controllers\KontrakController;

        // Landing pagea
        Route::get('/', function () {
            return view('welcome'); // halaman selamat datang
        })->name('welcome');

        // Authentication Routes - ADD THIS
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Admin Login (alternative route)
        Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
        Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

        // Admin Routes (protected)
        Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
            Route::resource('offices', PlnOfficeController::class);
            Route::resource('gedung', GedungController::class);
            Route::resource('kontrak', KontrakController::class);
            Route::resource('operasional', \App\Http\Controllers\OperasionalController::class);
            // Remove nested resource route for realisasi under kontrak
            Route::get('/map', [PlnOfficeController::class, 'mapView'])->name('map');

            // Add top-level realisasi resource route
            Route::resource('realisasi', \App\Http\Controllers\RealisasiController::class);
        });

        // User Routes (no login required)
        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [PlnOfficeController::class, 'userIndex'])->name('offices.index');
            Route::get('/map', [PlnOfficeController::class, 'userMap'])->name('map');
            Route::get('/offices/{id}', [UserOfficeController::class, 'show'])->name('offices.show');
            Route::get('/gedung/{id}', [UserOfficeController::class, 'gedungShow'])->name('gedung.show');
        });

        // Redirect admin to login if not authenticated
        Route::get('/admin', function () {
            return redirect()->route('admin.login');
        });
