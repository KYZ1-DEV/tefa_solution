<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\IndustriController;

Route::middleware(['guest'])->group(function () {
    Route::view('/home', 'home');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'registrasi'])->name('register.show');

    Route::get('/register/schools', [AuthController::class, 'registrasiSekolah'])->name('register.schools.show');
    Route::get('/register/industries', [AuthController::class, 'registrasiIndustri'])->name('register.industries.show');

    Route::post('/schools/register', [AuthController::class, 'schoolRegister'])->name('auth.schools.register');
    Route::post('/industries/register', [AuthController::class, 'industriRegister'])->name('auth.industries.register');
});


Route::get('/',[AuthController::class,'auth']);


Route::middleware(['auth'])->group(function () {
    // Dashboard    
    Route::get('/schools', [SekolahController::class, 'index'])->name('schools.index')->middleware('userAkses:sekolah');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('userAkses:admin');
    Route::get('/industries', [IndustriController::class, 'index'])->name('industries.index')->middleware('userAkses:industri');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Admin Profile & Password
    Route::prefix('admin')->middleware('userAkses:admin')->group(function () {
        Route::post('/upload-template', [AdminController::class, 'uploadTemplate'])->name('admin.upload.template');
        Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile.show');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::get('/password', [AdminController::class, 'password'])->name('admin.password.show');
        Route::put('/password', [AdminController::class, 'updatePassword'])->name('admin.password.update');

        // User Management
        Route::get('/users', [AdminController::class, 'user'])->name('admin.users.index');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
        Route::post('/usersCreate', [AdminController::class, 'storeUser'])->name('admin.users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

        // School Management
        Route::get('/schools', [AdminController::class, 'dataSekolah'])->name('admin.schools.index');
        Route::get('/schools/create', [AdminController::class, 'createSekolah'])->name('admin.schools.create');
        Route::post('/schoolsCreate', [AdminController::class, 'storeSekolah'])->name('admin.schools.store');
        Route::get('/schools/{id}/edit', [AdminController::class, 'editSekolah'])->name('admin.schools.edit');
        Route::put('/schools/{id}', [AdminController::class, 'updateSekolah'])->name('admin.schools.update');
        Route::delete('/schools/{id}', [AdminController::class, 'destroySekolah'])->name('admin.schools.destroy');
        Route::get('/schools/{id}', [AdminController::class, 'showSekolah'])->name('admin.schools.show');

        // Industry Management
        Route::get('/industries', [AdminController::class, 'dataIndustri'])->name('admin.industries.index');
        Route::get('/industries/create', [AdminController::class, 'createIndustri'])->name('admin.industries.create');
        Route::post('/industriesCreate', [AdminController::class, 'storeIndustri'])->name('admin.industries.store');
        Route::get('/industries/{id}/edit', [AdminController::class, 'editIndustri'])->name('admin.industries.edit');
        Route::put('/industries/{id}', [AdminController::class, 'updateIndustri'])->name('admin.industries.update');
        Route::delete('/industries/{id}', [AdminController::class, 'destroyIndustri'])->name('admin.industries.destroy');
        Route::get('/industries/{id}', [AdminController::class, 'showIndustri'])->name('admin.industries.show');
        
        Route::patch('/industries/verified/{id}', [AdminController::class, 'verified'])->name('admin.industries.verified');
        Route::patch('/industries/unverified/{id}', [AdminController::class, 'unverified'])->name('admin.industries.unverified');

        // Partner Management
        Route::get('/partners', [AdminController::class, 'dataMitra'])->name('admin.partners.index');
        Route::get('/partners/create', [AdminController::class, 'createMitra'])->name('admin.partners.create');
        Route::post('/partnersCreate', [AdminController::class, 'storeMitra'])->name('admin.partners.store');
        Route::get('/partners/{id}/edit', [AdminController::class, 'editMitra'])->name('admin.partners.edit');
        Route::put('/partners/{id}', [AdminController::class, 'updateMitra'])->name('admin.partners.update');
        Route::delete('/partners/{id}', [AdminController::class, 'destroyMitra'])->name('admin.partners.destroy');
        Route::get('/partners/{id}', [AdminController::class, 'showMitra'])->name('admin.partners.show');
    });

    // Industry Profile & Password
    Route::prefix('industries')->middleware('userAkses:industri')->group(function () {
        Route::get('/profile', [IndustriController::class, 'profile'])->name('industries.profile.show');
        Route::put('/profile', [IndustriController::class, 'updateProfile'])->name('industries.profile.update');
        Route::get('/password', [IndustriController::class, 'password'])->name('industries.password.show');
        Route::put('/password', [IndustriController::class, 'updatePassword'])->name('industries.password.update');
        Route::get('/assistance-monitoring', [IndustriController::class, 'monitoringBantuan'])->name('industries.assistance-monitoring');
        Route::put('/mitra/{id}', [IndustriController::class, 'updateMitra'])->name('mitra.update');
        Route::put('/laporan/{id}', [IndustriController::class, 'updateLaporan'])->name('laporan.update');

        Route::get('/schools', [IndustriController::class, 'listSekolah'])->name('industries.schools.index');
        Route::get('/download/{id}', [IndustriController::class, 'downloadLaporan'])->name('downloadLaporan');
        Route::post('/giveHelp', [IndustriController::class, 'giveHelp'])->name('industries.giveHelps.store');
        Route::get('/helps', [IndustriController::class, 'dataBantuan'])->name('industries.helps.index');
        Route::post('/helpsCreate', [IndustriController::class, 'storeBantuan'])->name('industries.helps.store');
        Route::put('/helps/Update', [IndustriController::class, 'updateBantuan'])->name('industries.helps.update');
        Route::delete('/helps/{id}', [IndustriController::class, 'destroyBantuan'])->name('industries.helps.destroy');
    });


    // School Profile & Password
    Route::prefix('schools')->middleware('userAkses:sekolah')->group(function () {
        Route::get('/profile', [SekolahController::class, 'profile'])->name('schools.profile.show');
        Route::put('/profile', [SekolahController::class, 'updateProfile'])->name('schools.profile.update');
        Route::get('/password', [SekolahController::class, 'password'])->name('schools.password.show');
        Route::put('/password', [SekolahController::class, 'updatePassword'])->name('schools.password.update');
        Route::get('/assistance-monitoring', [SekolahController::class, 'monitoringBantuan'])->name('schools.assistance-monitoring');
        Route::get('/progress', [SekolahController::class, 'progress'])->name('progress');
        Route::get('/information_progress', [SekolahController::class, 'information_progress'])->name('information_progress');
        Route::post('/laporan', [SekolahController::class, 'storeLaporan'])->name('upload.laporan');
        Route::get('/laporan', [SekolahController::class, 'showInformationProgress'])->name('schools.laporan.show');
        Route::get('/laporan/{id}', [SekolahController::class, 'show'])->name('laporan.show');
        Route::get('/laporan/{id}/edit', [SekolahController::class, 'edit_laporan'])->name('schools.laporan.edit');
        Route::put('/laporan/{id}', [SekolahController::class, 'update_laporan'])->name('schools.laporan.update');
    
        // Route::post('/laporan/{id}/update-status', [IndustriController::class, 'updateLaporanStatus'])->name('laporan.update.status');
    });
});
