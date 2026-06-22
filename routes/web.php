<?php

use App\Http\Controllers\Admin\AssignOrphansToSponsorController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminLogoutController;
use App\Http\Controllers\Admin\Auth\ForgetPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\ChangeSponsoredOrphanStatusController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DifficultCaseFamilyController;
use App\Http\Controllers\Admin\DifficultCaseFamilySearchController;
use App\Http\Controllers\Admin\DifficultCaseFamilySearchExcelExportController;
use App\Http\Controllers\Admin\ExportDifficultCaseFamiliesToExcelController;
use App\Http\Controllers\Admin\ExportSpecialNeedsPeopleToExcelController;
use App\Http\Controllers\Admin\ExportSponsorsToExcelController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\FamilyExcelExportController;
use App\Http\Controllers\Admin\FamilyReportController;
use App\Http\Controllers\Admin\FamilySearchController;
use App\Http\Controllers\Admin\FamilySearchExcelExportController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrphanController;
use App\Http\Controllers\Admin\OrphanExcelExportController;
use App\Http\Controllers\Admin\OrphanReportController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RolePermissionsController;
use App\Http\Controllers\Admin\SpecialNeedsPersonController;
use App\Http\Controllers\Admin\SpecialNeedsPersonSearchController;
use App\Http\Controllers\Admin\SpecialNeedsPersonSearchExcelExportController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\SupportProgramController;
use App\Http\Controllers\Admin\UpdatePasswordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SupportProgramEntryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
  return view('home');
})->name('home');

// routes/web.php
// Route::get('/test-404', function () {
//     abort(404);
// })->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {

  Route::middleware(['guest:web'])->group(function () {
    Route::view('/login', 'admins.auth.login')->name('login');
    Route::post('/login', [AdminLoginController::class, 'check'])->middleware('throttle:login')->name('check');
    // forget - Reset Password
    Route::get('/forget-password', [ForgetPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.form');
    Route::post('/forget-password', [ForgetPasswordController::class, 'sendResetPasswordLink'])->name('forget.password.create');
    Route::get('/reset-password', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.form');
    Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('reset.password');
  });

  // Route::middleware(['auth:web', 'XssSanitizer'])->group(function () {
  Route::middleware(['auth:web', 'checkStatus:web'])->group(function () {

    // Route::get('test', function () {
    //   Storage::disk('google')->put('hello.txt', "hello world");
    // });
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    // governorates & cities
    Route::resource('governorates', GovernorateController::class)->except('show');
    Route::get('/get-governorates', [GovernorateController::class, 'governoratesDataTable'])->name('get-governorates');
    Route::get('/get_cities/{id}', [GovernorateController::class, 'getCities'])->name('get_cities');
    Route::resource('cities', CityController::class)->except('show');
    Route::get('/get-cities', [CityController::class, 'citiesDataTable'])->name('get-cities');
    // Users
    Route::resource('users', UserController::class);
    Route::get('get-users', [UserController::class, 'usersDataTable'])->name('get-users');
    Route::post('users/{id}/change-status', [UserController::class, 'changeUserStatus'])->name('users.status.change');
    // Sponsors Routes
    Route::resource('/sponsors', SponsorController::class)->except('show');
    Route::get('sponsors/get-sponsors', [SponsorController::class, 'getSponsors'])->name('get-sponsors');
    Route::post('sponsors/{id}/change-status', [SponsorController::class, 'changeSponsorStatus'])->name('sponsors.status.change');
    Route::get('export-sponsors', [ExportSponsorsToExcelController::class, 'exportSponsors'])->name('sponsors.export');
    //families
    Route::resource('families', FamilyController::class);
    Route::get('get-families', [FamilyController::class, 'getFamilies'])->name('get-families');
    Route::get('view-family-attachment/{attachment}', [FamilyController::class, 'viewFamilyAttachment'])->name('view_family_attachment');
    Route::get('download-family-attachment/{attachment}', [FamilyController::class, 'downloadFamilyAttachment'])->name('download_family_attachment');
    Route::post('delete-family-attachment/{attachment}', [FamilyController::class, 'deleteFamilyAttachment'])->name('delete_family_attachment');
    Route::get('families-export', [FamilyExcelExportController::class, 'exportFamilies'])->name('families.export');
    Route::get('family-reports/{family}', [FamilyReportController::class, 'create'])->name('family-report.create');
    Route::resource('family-report', FamilyReportController::class)->except('index', 'create');
    Route::get('add-report', [FamilyController::class, 'addFamilyReport'])->name('add_family_report');
    Route::post('store-report', [FamilyController::class, 'storeFamilyReport'])->name('store_family_report');
    // Orphans
    Route::resource('orphans', OrphanController::class)->except('create');
    Route::get('get-orphans', [OrphanController::class, 'getOrphans'])->name('get-orphans');
    Route::get('orphans/create/{family}', [OrphanController::class, 'create'])->name('orphans.create');
    Route::get('view-orphan-attachment/{attachment}', [OrphanController::class, 'viewOrphanAttachment'])->name('view_orphan_attachment');
    Route::get('download-orphan-attachment/{attachment}', [OrphanController::class, 'downloadOrphanAttachment'])->name('download_orphan_attachment');
    Route::post('delete-orphan-attachment/{attachment}', [OrphanController::class, 'deleteOrphanAttachment'])->name('delete_orphan_attachment');
    // change orphan sponsored status
    Route::patch('/change-sponsored-orphan-to-unsponsored/{orphan}', [OrphanController::class, 'changeSponsoredOrphanToUnsponsored'])->name('change.orphan-status-to-unsponsored');
    Route::patch('/change-orphan-status-to-ended/{orphan}', [OrphanController::class, 'changeOrphanStatusToEnded'])->name('change.orphan-status-to-ended');
    Route::get('orphans-export', [OrphanExcelExportController::class, 'exportOrphans'])->name('orphans.export');
    // Assign Orphans to Sponsors
    Route::get('assign-orphans-to-sponsor', [AssignOrphansToSponsorController::class, 'index'])->name('assign-orphans-to-sponsor.index');
    Route::post('assign-orphans-to-sponsor', [AssignOrphansToSponsorController::class, 'store'])->name('assign-orphans-to-sponsor.store');
    //Orphans Reports
    Route::get('orphan-reports/{orphan}', [OrphanReportController::class, 'create'])->name('orphan-report.create');
    Route::resource('orphan-report', OrphanReportController::class)->except('index', 'create');
    Route::get('view-orphan-report-attachment/{attachment}',   [OrphanReportController::class, 'viewOrphanReportAttachment'])->name('view_orphan_report_attachment');
    Route::get('download-orphan-report-attachment/{attachment}', [OrphanReportController::class, 'downloadOrphanReportAttachment'])->name('download_orphan_report_attachment');
    Route::post('delete-orphan-report-attachment/{attachment}', [OrphanReportController::class, 'deleteOrphanReportAttachment'])->name('delete_orphan_report_attachment');
    // Families Difficult Cases
    Route::resource('difficult-case-families', DifficultCaseFamilyController::class);
    Route::get('get-difficult-case-families', [DifficultCaseFamilyController::class, 'getDifficultCaseFamilies'])->name('get-difficult-case-families');
    Route::get('export-difficult-case-families', [ExportDifficultCaseFamiliesToExcelController::class, 'exportDifficultCaseFamilies'])->name('difficult-case-families.export');
    // special needs people
    Route::resource('special-needs-people', SpecialNeedsPersonController::class);
    Route::get('get-special-needs-people', [SpecialNeedsPersonController::class, 'getSpecialNeedsPeople'])->name('get-special-needs-people');
    Route::get('export-special-needs-people', [ExportSpecialNeedsPeopleToExcelController::class, 'exportSpecialNeedsPeople'])->name('special-needs-people.export');
    // support programs
    Route::resource('support-programs', SupportProgramController::class)->except('show');
    Route::get('get-support-programs', [SupportProgramController::class, 'data'])->name('get-support-programs');
    // support program entries
    Route::resource('support-program-entries', SupportProgramEntryController::class);
    Route::get('get-support-program-entries', [SupportProgramEntryController::class, 'getSupportProgramEntries'])->name('get-support-program-entries');
    Route::post('delete-support-program-entry-attachment/{attachment}', [SupportProgramEntryController::class, 'deleteSupportProgramEntryAttachment'])->name('delete_support_program_entry_attachment');
    // Reports
    //Families Search Reports
    Route::get('families-search', [FamilySearchController::class, 'index'])->name('families.search.index');
    Route::post('families-search', [FamilySearchController::class, 'search'])->name('families.search');
    Route::get('export-families-search', [FamilySearchExcelExportController::class, 'exportFamiliesSearch'])->name('families.search.export');
    // Families Difficult Cases Search
    Route::get('difficult-case-families-search', [DifficultCaseFamilySearchController::class, 'index'])->name('difficult-case-families.search.index');
    Route::post('difficult-case-families-search', [DifficultCaseFamilySearchController::class, 'search'])->name('difficult-case-families.search');
    Route::get('export-difficult-case-families-search', [DifficultCaseFamilySearchExcelExportController::class, 'exportDifficultCaseFamiliesSearch'])->name('difficult-case-families.search.export');
    // Special Needs People Search
    Route::get('special-needs-people-search', [SpecialNeedsPersonSearchController::class, 'index'])->name('special-needs-people.search.index');
    Route::post('special-needs-people-search', [SpecialNeedsPersonSearchController::class, 'search'])->name('special-needs-people.search');
    Route::get('export-special-needs-people-search', [SpecialNeedsPersonSearchExcelExportController::class, 'exportSpecialNeedsPeopleSearch'])->name('special-needs-people.search.export');
    //backups
    Route::get('/backups', [BackupController::class, 'index'])->name('backups.index');
    Route::get('/backup/create', [BackupController::class, 'createBackup'])->name('backups.create');
    Route::get('/backup/download/{backupName}', [BackupController::class, 'downloadBackup'])->name('backups.download');
    Route::post('/backups/delete/{backupName}', [BackupController::class, 'destroy'])->name('backups.destroy');
    Route::post('/backups/bulk-delete', [BackupController::class, 'bulkDestroy'])->name('backups.bulkDestroy');
    //Roles & permissions
    Route::resource('/roles', RoleController::class)->except('show');
    Route::get('roles/get-roles', [RoleController::class, 'getRoles'])->name('get-roles');
    Route::resource('/permissions', PermissionController::class)->except('show');
    Route::get('permissions/get-permissions', [PermissionController::class, 'getPermissions'])->name('get-permissions');
    Route::resource('/role-permissions', RolePermissionsController::class);
    // profile  & UpdatePassword & logout 
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'updateAdminProfile'])->name('profile.update');
    Route::get('/password', [UpdatePasswordController::class, 'index'])->name('password');
    Route::post('/password/update', [UpdatePasswordController::class, 'updatePassword'])->name('update.password');
    Route::post('/logout', [AdminLogoutController::class, 'logout'])->name('logout');
  });
});

require __DIR__ . '/sponsor.php';
