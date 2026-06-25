<?php

use App\Http\Controllers\Sponsor\Auth\ForgetPasswordController;
use App\Http\Controllers\Sponsor\Auth\ResetPasswordController;
use App\Http\Controllers\Sponsor\Auth\SponsorLoginController;
use App\Http\Controllers\Sponsor\Auth\SponsorLogoutController;
use App\Http\Controllers\Sponsor\HomeController;
use App\Http\Controllers\Sponsor\OrphanReportController;
use App\Http\Controllers\Sponsor\ProfileController;
use App\Http\Controllers\Sponsor\SponsoredOrphanController;
use App\Http\Controllers\Sponsor\UnSponsoredOrphanController;
use App\Http\Controllers\Sponsor\UpdatePasswordController;
use Illuminate\Support\Facades\Route;



Route::prefix('sponsor')->name('sponsor.')->group(function () {

  Route::middleware(['guest:sponsor'])->group(function () {
    Route::view('/login', 'sponsors.auth.login')->name('login');
    Route::post('/login', [SponsorLoginController::class, 'check'])->middleware('throttle:login')->name('check');
    // forget - Reset Password
    Route::get('/forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.form');
    Route::post('/forget-password', [ForgetPasswordController::class, 'sendResetPasswordLink'])->name('forget.password.create');
    Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.form');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset.password');
  });

  Route::middleware(['auth:sponsor', 'checkStatus:sponsor'])->group(function () {

    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Sponsored Orphans
    Route::get('/sponsored-orphans', [SponsoredOrphanController::class, 'index'])->name('sponsored-orphans');
    Route::get('/sponsored-orphans/get-data', [SponsoredOrphanController::class, 'getSponsoredOrphans'])->name('get-sponsored-orphans');
    Route::get('/sponsored-orphans/{orphan}', [SponsoredOrphanController::class, 'sponsoredOrphanDetails'])->name('sponsored-orphans.details');
    //Orphans Reports
    Route::get('orphan-report/{orphan_report}', [OrphanReportController::class, 'show'])->name('orphan-report.show');
    Route::get('view-orphan-report-attachment/{attachment}',   [OrphanReportController::class, 'viewOrphanReportAttachment'])->name('view_orphan_report_attachment');
    // Un Sponsored Orphans
    Route::get('/unsponsored-orphans', [UnSponsoredOrphanController::class, 'index'])->name('unsponsored-orphans');
    Route::get('/unsponsored-orphans/data', [UnSponsoredOrphanController::class, 'getData'])->name('unsponsored-orphans.data');
    // Profile and Password
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateSponsorProfile'])->name('profile.update');
    Route::get('/password', [UpdatePasswordController::class, 'index'])->name('password');
    Route::post('/password/update', [UpdatePasswordController::class, 'updatePassword'])->name('update.password');
    Route::post('/logout', [SponsorLogoutController::class, 'logout'])->name('logout');
  });
});
