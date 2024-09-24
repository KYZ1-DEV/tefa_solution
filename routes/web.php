<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\IndustriController;




Route::middleware(['guest'])->group(function() {
    Route::view('/', view: 'home');
    Route::post('/login',[AuthController::class, 'login'])->name('auth');
    Route::get('/user/login',[AuthController::class, 'index'])->name('login');
    Route::post('/registrasi',[AuthController::class, 'register'])->name('register');
    Route::get('/user/registrasi',[AuthController::class, 'registrasi'])->name('registrasi');
});


Route::middleware(['auth'])->group( function (){

        // Dashboard
        Route::redirect('/home', '/sekolah');
        Route::get( '/sekolah',  [SekolahController::class,'index'])->name('sekolah')->middleware( 'userAkses:sekolah');
        Route::get( '/admin',  [AdminController::class,'index'])->name('admin')->middleware( 'userAkses:admin');
        Route::get( '/industri',  [IndustriController::class,'index'])->name('industri')->middleware( 'userAkses:industri');
        Route::post( '/logout',  [AuthController::class, 'logout'])->name('logout');


#Dashbord admin
        // Dashboard Admin/Profile && password
        Route::get('/admin/profile' , [AdminController::class,'profile'])->name('profile')->middleware( 'userAkses:admin');
        Route::put('/admin/profile/edit' , [AdminController::class,'editProfile'])->middleware( 'userAkses:admin');

        Route::get('/admin/password' , [AdminController::class,'password'])->name(name: 'password')->middleware( 'userAkses:admin');
        Route::put('/admin/editPassword' , [AdminController::class,'editPassword'])->middleware( 'userAkses:admin');



        // Dashboard Admin/Kelola_user
        Route::get('/admin/kelola_user', [AdminController::class,'user'])->name('user')->middleware( 'userAkses:admin');
        Route::get('/admin/tambah_user',[AdminController::class, 'tambahUser'])->middleware( 'userAkses:admin');
        Route::get('/admin/edit_User/{id}',[AdminController::class, 'editUser'])->middleware( 'userAkses:admin');


        // Action form
        Route::post('/tambahUser', [AdminController::class, 'createUser'])->middleware( 'userAkses:admin');
        Route::put('/ubahUser', [AdminController::class, 'updateUser'])->middleware( 'userAkses:admin');
        Route::delete('/hapusUser/{id}',[AdminController::class, 'deleteUser'])->middleware( 'userAkses:admin');



        // Dashboard Admin/Data_sekolah
        Route::get('/admin/data_sekolah', [AdminController::class,'dataSekolah'])->name('dataSekolah')->middleware( 'userAkses:admin');
        Route::get('/admin/tambah_sekolah',[AdminController::class, 'tambahDataSekolah'])->middleware( 'userAkses:admin');
        Route::get('admin/edit_sekolah/{id}',[AdminController::class, 'editDataSekolah'])->middleware( 'userAkses:admin');

        // Action form
        Route::post('/tambahSekolah', [AdminController::class, 'createSekolah'])->middleware( 'userAkses:admin');
        Route::put('/ubahSekolah', [AdminController::class, 'updateSekolah'])->middleware( 'userAkses:admin');
        Route::delete('/hapusSekolah/{id}',[AdminController::class, 'deleteSekolah'])->middleware( 'userAkses:admin');




        // Dashboard Admin/Data_Industri
        Route::get('/admin/data_industri', [AdminController::class,'dataIndustri'])->name('dataIndustri')->middleware( 'userAkses:admin');
        Route::get('/admin/tambah_industri',[AdminController::class, 'tambahDataIndustri'])->middleware( 'userAkses:admin');
        Route::get('admin/edit_industri/{id}',[AdminController::class, 'editDataIndustri'])->middleware( 'userAkses:admin');

        // Action form
        Route::post('/tambahIndustri', [AdminController::class, 'createIndustri'])->middleware( 'userAkses:admin');
        Route::put('/ubahIndustri', [AdminController::class, 'updateIndustri'])->middleware( 'userAkses:admin');
        Route::delete('/hapusIndustri/{id}',[AdminController::class, 'deleteIndustri'])->middleware( 'userAkses:admin');


        // Dashboard Admin/Data_Mitra
        Route::get('/admin/data_mitra', [AdminController::class,'dataMitra'])->name('dataMitra')->middleware( 'userAkses:admin');
        Route::get('/admin/tambah_mitra',[AdminController::class, 'tambahDataMitra'])->middleware( 'userAkses:admin');
        Route::get('admin/edit_mitra/{id}',[AdminController::class, 'editDataMitra'])->middleware( 'userAkses:admin');

        // Action form
        Route::post('/tambahMitra', [AdminController::class, 'createMitra'])->middleware( 'userAkses:admin');
        Route::put('/ubahMitra', [AdminController::class, 'updateMitra'])->middleware( 'userAkses:admin');
        Route::delete('/hapusMitra/{id}',[AdminController::class, 'deleteMitra'])->middleware( 'userAkses:admin');
#End admin


#Dashboard Industri
                // Dashboard Industri/Profile && password
                Route::get('/industri/profile' , [IndustriController::class,'profile'])->name('profileIndustri')->middleware( 'userAkses:industri');
                Route::put('/industri/profile/edit' , [IndustriController::class,'editProfile'])->middleware( 'userAkses:industri');
                Route::get('/industri/password' , [IndustriController::class,'password'])->name(name: 'passwordIndustri')->middleware( 'userAkses:industri');
                Route::put('/industri/editPassword' , [IndustriController::class,'editPassword'])->middleware( 'userAkses:industri');

                // Dashboard Industri/Monitoring Bantuan
                 Route::get('/industri/monitoring_bantuan', [IndustriController::class,'monitoringBantuan'])->name('monitoringBantuan')->middleware( 'userAkses:industri');
                //     Route::get('/industri/tambah_Bantuan',[IndustriController::class, 'tambahDataBantuan']);
                //     Route::get('/industri/edit_Bantuan/{id}',[IndustriController::class, 'editDataBantuan']);
                //     // Action form
                //     Route::post('/tambahBantuan', [IndustriController::class, 'createBantuan']);
                //     Route::put('/ubahBantuan', [IndustriController::class, 'updateBantuan']);
                //     Route::delete('/hapusBantuan/{id}',[IndustriController::class, 'deleteBantuan']);


                // Dashboard Industri/List Sekolah
                Route::get('/industri/list_sekolah', [IndustriController::class,'listSekolah'])->name('listSekolah')->middleware( 'userAkses:industri');

                // Dashboard Industri/Laporan
                Route::get('/industri/laporan', [IndustriController::class,'laporan'])->name('laporan')->middleware( 'userAkses:industri');

#End Industri


#Dashboard Sekolah
                // Dashboard Sekolah/Profile && password
                Route::get('/sekolah/profile' , [SekolahController::class,'profile'])->name('profileSekolah')->middleware( 'userAkses:sekolah');
                Route::put('/sekolah/profile/edit' , [SekolahController::class,'editProfile'])->middleware( 'userAkses:sekolah');
                Route::get('/sekolah/password' , [SekolahController::class,'password'])->name(name: 'passwordSekolah')->middleware( 'userAkses:sekolah');
                Route::put('/sekolah/editPassword' , [SekolahController::class,'editPassword'])->middleware( 'userAkses:sekolah');

                // Dashboard Sekolah/Monitoring Bantuan
                 Route::get('/sekolah/monitoring_bantuan', [SekolahController::class,'monitoringBantuan'])->name('monitoringBantuanSekolah')->middleware( 'userAkses:sekolah');


                 // Dashboard Sekolah/Laporan
                Route::get('/sekolah/progres0Persen', [SekolahController::class,'progress0Persen'])->name('0Persen')->middleware( 'userAkses:sekolah');
                Route::get('/sekolah/progres50Persen', [SekolahController::class,'progress50Persen'])->name('50Persen')->middleware( 'userAkses:sekolah');
                Route::get('/sekolah/progres100Persen', [SekolahController::class,'progress100Persen'])->name('100Persen')->middleware( 'userAkses:sekolah');

#End Sekolah



});
