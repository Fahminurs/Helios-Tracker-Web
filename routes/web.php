<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;  
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UpdateAccountController;


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

        Route::get('/device-list', [DashboardController::class, 'index'])->name('device-list');

        Route::get('/Download', function () {
            return view('Download');
        });

        Route::get('/Histori', function () {
            return view('histori');
        })->name('Histori');
    });

    // Admin Routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/device-info', [DashboardController::class, 'getDeviceInfo'])->name('device.info');
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

