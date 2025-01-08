<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;  
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UpdateAccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\loginadminController;

// Login Routes
Route::get('/', function() {
    return app(LoginController::class)->showLoginForm();
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// Registration Routes
Route::get('/registrasi', [RegistrationController::class, 'showRegistrationForm'])->name('registrasi');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // User Routes
    Route::middleware(['role:user'])->group(function () {
        Route::get('/main', [DashboardController::class, 'index'])->name('main');
        Route::get('/main/{kode_perangkat}', [DashboardController::class, 'showDeviceMain'])->name('main.device');
        
        // Settings Routes
        Route::prefix('settings')->group(function () {
            Route::get('/', function () {
                return view('settings');
            })->name('settings');

            Route::get('/update-account', function () {
                return view('settings.update-account');
            })->name('update-account');

            Route::post('/update-account', [UpdateAccountController::class, 'update'])
                ->name('update-account.update');

            Route::get('/change-password', function () {
                return view('settings.change-password');
            })->name('change-password');

            Route::get('/about-app', function () {
                return view('settings.about-app');
            })->name('about-app');

            Route::post('/change-password', [UpdateAccountController::class, 'update_password'])
                ->name('change-password.update');
        });

        Route::get('/device-list', [DashboardController::class, 'deviceList'])->name('device-list');
        Route::get('/device-list/delete/{id}', [DashboardController::class, 'deleteDevice'])->name('device.delete');
        
        Route::get('/Download', function () {
            return view('Download');
        });
        
        Route::get('/Histori', function () {
            return view('histori');
        })->name('Histori');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', [loginadminController::class, 'index'])->name('dashboard');
        
        // Profile Routes
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::put('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    });

    // Route untuk generate device code
    Route::post('/generate-device-code', [loginadminController::class, 'generateDeviceCode'])
        ->middleware('auth');

    // Profile Routes (accessible by all authenticated users)
    Route::middleware(['auth'])->group(function () {
        Route::get('/update-profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    // Device routes
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::post('/register-device', [DashboardController::class, 'registerDevice'])->name('device.register');
    });

    // Location update route
    Route::post('/update-location', [DashboardController::class, 'updateLocation'])->name('update.location');
});

// Logout Route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Alert Route
Route::get('/show-alert', function () {
    if (!session()->has('alert')) {
        return redirect('/');
    }
    return view('show-alert');
})->name('show.alert');

// Debug Route
