<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PaymentCardController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;


Route::any('/switch-locale/{locale}', [LanguageController::class, 'switchLocale'])->name('switch-language');

Route::get('/', function () {
    return view('auth.login');
});




Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


    // Password Routes
    Route::get('/passwords/index', [PasswordController::class, 'index'])->name('passwords.index');
    Route::post('/form/password/store', [PasswordController::class, 'store'])->name('form.password.store');
    Route::patch('/form/password/{id}', [PasswordController::class, 'update'])->name('form.password.update');
    Route::delete('/form/password/{id}', [PasswordController::class, 'destroy'])->name('form.password.destroy');

    // Note Routes
    Route::get('/notes/index', [NoteController::class, 'index'])->name('notes.index');
    Route::post('/form/note/store', [NoteController::class, 'store'])->name('form.note.store');
    Route::patch('/form/note/{id}', [NoteController::class, 'update'])->name('form.note.update');
    Route::delete('/form/note/{id}', [NoteController::class, 'destroy'])->name('form.note.destroy');

    // Address Routes
    Route::get('/addresses/index', [AddressController::class, 'index'])->name('addresses.index');
    Route::post('/form/address/store', [AddressController::class, 'store'])->name('form.address.store');
    Route::patch('/form/address/{id}', [AddressController::class, 'update'])->name('form.address.update');
    Route::delete('/form/address/{id}', [AddressController::class, 'destroy'])->name('form.address.destroy');

    // Payment Card
    Route::get('/payment-cards/index', [PaymentCardController::class, 'index'])->name('payment-cards.index');
    Route::post('/form/payment-card/store', [PaymentCardController::class, 'store'])->name('form.payment_card.store');
    Route::patch('/form/payment-card/{id}', [PaymentCardController::class, 'update'])->name('form.payment_card.update');
    Route::delete('/form/payment-card/{id}', [PaymentCardController::class, 'destroy'])->name('form.payment_card.destroy');

    // Bank Account Card
    Route::get('/bank-accounts/index', [BankAccountController::class, 'index'])->name('bank-accounts.index');
    Route::post('/form/bank-account/store', [BankAccountController::class, 'store'])->name('form.bank_account.store');
    Route::patch('/form/bank-account/{id}', [BankAccountController::class, 'update'])->name('form.bank_account.update');
    Route::delete('/form/bank-account/{id}', [BankAccountController::class, 'destroy'])->name('form.bank_account.destroy');




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
