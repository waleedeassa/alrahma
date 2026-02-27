<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sponsor\HomeController;
use App\Http\Controllers\Sponsor\Auth\SponsorLoginController;
use App\Http\Controllers\Sponsor\Auth\ResetPasswordController;
use App\Http\Controllers\Sponsor\Auth\SponsorLogoutController;
use App\Http\Controllers\Sponsor\Auth\ForgetPasswordController;



Route::prefix('sponsor')->name('sponsor.')->group(function () {

  Route::middleware(['guest:sponsor'])->group(function () {
    Route::view('/login', 'sponsors.auth.login')->name('login');
    Route::post('/login', [SponsorLoginController::class, 'check'])->name('check');
    // forget - Reset Password
    Route::get('/forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.form');
    Route::post('/forget-password', [ForgetPasswordController::class, 'sendResetPasswordLink'])->name('forget.password.create');
    Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.form');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset.password');
  });

  // Route::middleware(['auth:sponsor', 'XssSanitizer'])->group(function () {
  Route::middleware(['auth:sponsor', 'checkStatus:sponsor'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    // Route::post('/profile/update', [ProfileController::class, 'updateSponsorProfile'])->name('profile.update');
    // Route::get('/password', [UpdatePasswordController::class, 'index'])->name('password');
    // Route::post('/password/update', [UpdatePasswordController::class, 'updatePassword'])->name('update.password');
    Route::post('/logout', [SponsorLogoutController::class, 'logout'])->name('logout');
  });
});
