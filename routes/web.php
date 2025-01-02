<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;


Route::any('/switch-locale/{locale}', [LanguageController::class, 'switchLocale'])->name('switch-language');

Route::get('/', function () {
    return view('auth.login');
});




Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::delete('/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');


    // Route::post('/password-store', [PasswordController::class, 'store'])->name('form.password.store');


    Route::post('form/password/store', [PasswordController::class, 'store'])->name('form.password.store');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
