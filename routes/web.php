<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\IndustriController;

Route::middleware(['guest'])->group(function() {
    Route::view('/', 'home');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/register', [AuthController::class, 'registrasi'])->name('register.show');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::redirect('/home', '/schools');
    Route::get('/schools', [SekolahController::class, 'index'])->name('schools.index')->middleware('userAkses:sekolah');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('userAkses:admin');
    Route::get('/industries', [IndustriController::class, 'index'])->name('industries.index')->middleware('userAkses:industri');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // Admin Profile & Password
    Route::prefix('admin')->middleware('userAkses:admin')->group(function () {
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
        
        // Industry Management
        Route::get('/industries', [AdminController::class, 'dataIndustri'])->name('admin.industries.index');
        Route::get('/industries/create', [AdminController::class, 'createIndustri'])->name('admin.industries.create');
        Route::post('/industriesCreate', [AdminController::class, 'storeIndustri'])->name('admin.industries.store');
        Route::get('/industries/{id}/edit', [AdminController::class, 'editIndustri'])->name('admin.industries.edit');
        Route::put('/industries/{id}', [AdminController::class, 'updateIndustri'])->name('admin.industries.update');
        Route::delete('/industries/{id}', [AdminController::class, 'destroyIndustri'])->name('admin.industries.destroy');

        // Partner Management
        Route::get('/partners', [AdminController::class, 'dataMitra'])->name('admin.partners.index');
        Route::get('/partners/create', [AdminController::class, 'createMitra'])->name('admin.partners.create');
        Route::post('/partnersCreate', [AdminController::class, 'storeMitra'])->name('admin.partners.store');
        Route::get('/partners/{id}/edit', [AdminController::class, 'editMitra'])->name('admin.partners.edit');
        Route::put('/partners/{id}', [AdminController::class, 'updateMitra'])->name('admin.partners.update');
        Route::delete('/partners/{id}', [AdminController::class, 'destroyMitra'])->name('admin.partners.destroy');
    });

    // Industry Profile & Password
    Route::prefix('industries')->middleware('userAkses:industri')->group(function () {
        Route::get('/profile', [IndustriController::class, 'profile'])->name('industries.profile.show');
        Route::put('/profile', [IndustriController::class, 'updateProfile'])->name('industries.profile.update');
        Route::get('/password', [IndustriController::class, 'password'])->name('industries.password.show');
        Route::put('/password', [IndustriController::class, 'updatePassword'])->name('industries.password.update');
        Route::get('/assistance-monitoring', [IndustriController::class, 'monitoringBantuan'])->name('industries.assistance-monitoring');
        Route::get('/schools', [IndustriController::class, 'listSekolah'])->name('industries.schools.index');
        Route::get('/reports', [IndustriController::class, 'laporan'])->name('industries.reports.index');
    });

    // School Profile & Password
    Route::prefix('schools')->middleware('userAkses:sekolah')->group(function () {
        Route::get('/profile', [SekolahController::class, 'profile'])->name('schools.profile.show');
        Route::put('/profile', [SekolahController::class, 'updateProfile'])->name('schools.profile.update');
        Route::get('/password', [SekolahController::class, 'password'])->name('schools.password.show');
        Route::put('/password', [SekolahController::class, 'updatePassword'])->name('schools.password.update');
        Route::get('/assistance-monitoring', [SekolahController::class, 'monitoringBantuan'])->name('schools.assistance-monitoring');
        Route::get('/progress/0', [SekolahController::class, 'progress0Persen'])->name('schools.progress.0');
        Route::get('/progress/50', [SekolahController::class, 'progress50Persen'])->name('schools.progress.50');
        Route::get('/progress/100', [SekolahController::class, 'progress100Persen'])->name('schools.progress.100');
    });

});
