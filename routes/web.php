<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CutibawahanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\SuperadminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PengajuanController;

use App\Http\Controllers\ProfilController;

use App\Http\Controllers\DatapegawaiController;
use App\Http\Controllers\KassubagController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\RegisterController;


Route::get('/', function () {
    return view('login.login');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/signin', [AuthController::class, 'authenticate']);
Route::get('/signout', [AuthController::class, 'signout']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/signup', [RegisterController::class, 'signup']);

Route::group(['middleware' => ['AuthUser']], function () {
    
    Route::get('/user', [BerandaController::class, 'index']);
    Route::get('/logoutuser', [AuthController::class, 'logoutuser']);
    Route::get('/dataasn', [KassubagController::class, 'dataasn']);

    Route::get('/profiluser', [ProfilController::class, 'profiluser']);

    Route::get('/bantuan', [BantuanController::class, 'user']);
    #CUTI
    Route::get('/cuti', [CutiController::class, 'cuti']);
    Route::get('/pengajuan', [PengajuanController::class, 'index']);
    Route::post('/proseslibur', [PengajuanController::class, 'proseslibur']);
    
    Route::post('/submitcuti', [PengajuanController::class, 'insertcuti']);
    Route::post('/updatecuti', [PengajuanController::class, 'updatecuti']);
    
    Route::get('/cetak', [CetakController::class, 'cetak']);
    
    Route::get('/cutibawahan', [CutibawahanController::class, 'index']);

    Route::get('/detailbawahan/{id}', [CutibawahanController::class, 'detailbawahan']);


});

Route::group(['middleware' => ['AuthSuperadmin']], function () {

    Route::get('/superadmin', [SuperadminController::class, 'index']);
    
});

Route::group(['middleware' => ['AuthAdmin']], function () {

    Route::get('/admin', [AdminController::class, 'index']);

    Route::get('/viewpengajuan', [AdminController::class, 'viewpengajuan']);
    Route::get('/detailcuti/{id}', [AdminController::class, 'detailcuti']);
    Route::post('/validasicuti', [AdminController::class, 'validasicuti']);
    Route::post('/prosescuti', [AdminController::class, 'prosescuti']);
    Route::get('/cetakcuti', [CetakController::class, 'cetakcuti']);

    Route::get('/riwayatcuti', [AdminController::class, 'riwayatcuti']);
    Route::get('/detailriwayat/{id}', [AdminController::class, 'detailriwayat']);

    
    // Route::post('/terimaberkas', [AdminController::class, 'terimaberkas']);
    // Route::post('/tolakberkas', [AdminController::class, 'tolakberkas']);
    // Route::post('/validasipensiun', [AdminController::class, 'validasipensiun']);

    // Route::get('/viewkariskarsu', [AdminController::class, 'viewkariskarsu']);
    // Route::get('/validasikaris/{id}', [AdminController::class, 'validasikaris']);
    // Route::post('/confirmberkas', [AdminController::class, 'confirmberkas']);
    // Route::post('/rejectberkas', [AdminController::class, 'rejectberkas']);
    // Route::post('/validasikariskarsu', [AdminController::class, 'validasikariskarsu']);

    // Route::post('/cetaksk', [AdminController::class, 'cetaksk']);

    // Route::get('/deletekariskarsu/{id}', [AdminController::class, 'deletekariskarsu']);

    // Route::get('/deletepensiun/{id}', [AdminController::class, 'deletepensiun']);

});

Route::group(['middleware' => ['AuthKassubag']], function () {

    Route::get('/kassubag', [KassubagController::class, 'index']);

    Route::get('/dataasn', [KassubagController::class, 'dataasn']);
    Route::post('/insertpegawai', [KassubagController::class, 'insertpegawai']);
    Route::post('/updatepegawai', [KassubagController::class, 'updatepegawai']);
    Route::get('/deletepegawai/{id}', [KassubagController::class, 'deletepegawai']);

    Route::get('/pengajuanpensiun', [KassubagController::class, 'pengajuanpensiun'])->name('pengajuanpensiun');;

    Route::post('/sessionusulan', [KassubagController::class, 'sessionusulan']);

    Route::get('/createpensiun', [KassubagController::class, 'createpensiun']);

    Route::get('/createpengajuan/{id}', [KassubagController::class, 'createpengajuan'])->name('createpengajuan');

    Route::post('/insertpensiun', [KassubagController::class, 'insertpensiun']);
    
    Route::get('/deleteusulan/{id}', [KassubagController::class, 'deleteusulan']);

    Route::get('/berkaspensiun/{id}', [KassubagController::class, 'berkaspensiun']);

    Route::post('/insertberkas', [KassubagController::class, 'insertberkas']);
    Route::post('/konfirmberkas', [KassubagController::class, 'konfirmberkas']);

    Route::get('/pengajuankariskarsu', [KassubagController::class, 'pengajuankariskarsu']);
    Route::post('/insertkaris', [KassubagController::class, 'insertkaris']);
    
    Route::get('/anak/{id}', [KassubagController::class, 'anak']);    
    Route::post('/tambahanak', [KassubagController::class, 'tambahanak']);
    Route::post('/ubahanak', [KassubagController::class, 'ubahanak']);
    Route::get('/hapusanak/{id}', [KassubagController::class, 'hapusanak']);

    Route::get('/pasangan/{id}', [KassubagController::class, 'pasangan']);

    Route::post('/tambahpasangan', [KassubagController::class, 'tambahpasangan']);
    Route::post('/ubahpasangan', [KassubagController::class, 'ubahpasangan']);
    Route::get('/hapuspasangan/{id}', [KassubagController::class, 'hapuspasangan']);


    Route::get('/deletekaris/{id}', [KassubagController::class, 'deletekaris']);

    Route::get('/berkaskaris/{id}', [KassubagController::class, 'berkaskaris']);

});