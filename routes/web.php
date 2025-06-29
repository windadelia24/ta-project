<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KabidController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class,'index'])->name('login');
    Route::post('/', [SesiController::class,'login']);
    Route::get('/register', [SesiController::class, 'showRegister'])->name('register');
    Route::post('/register', [SesiController::class, 'register']);
});

Route::get('/forgot-password', [SesiController::class, 'showLinkRequestForm'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [SesiController::class, 'sendResetLinkEmail'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [SesiController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [SesiController::class, 'reset'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/home', function () {
    $user = Auth::user();

    switch ($user->role) {
        case 'admin':
            return redirect('/admin');
        case 'pengurus':
            return redirect('/pengurus');
        case 'pengawas':
            return redirect('/pengawas');
        case 'kadin':
            return redirect('/kabid');
        default:
            abort(403, 'Akses tidak diizinkan.');
    }
});

Route::middleware(['auth'])->group(function () {
    //profile
    Route::get('/profile', [SesiController::class,'profile'])->name('profile');
    Route::post('/profile', [SesiController::class,'updateprofile'])->name('updateprofile');
    //admin
    Route::get('/admin', [AdminController::class,'index'])->middleware('userAkses:admin')->name('admin');
    Route::get('/akun', [AdminController::class, 'listakun'])->middleware('userAkses:admin')->name('listakun');
    Route::get('/akun/tambah', [AdminController::class, 'tambahakun'])->middleware('userAkses:admin')->name('tambahakun');
    Route::post('/akun/tambah', [AdminController::class,'createakun'])->middleware('userAkses:admin')->name('createakun');
    Route::get('/akun/edit/{nik_nip}', [AdminController::class, 'editakun'])->middleware('userAkses:admin')->name('editakun');
    Route::post('/akun/edit/{nik_nip}', [AdminController::class, 'updateakun'])->middleware('userAkses:admin')->name('updateakun');
    Route::get('/akun/hapus/{nik_nip}', [AdminController::class, 'hapusakun'])->middleware('userAkses:admin')->name('hapusakun');
    Route::get('/akun/cari', [AdminController::class, 'cariakun'])->middleware('userAkses:admin')->name('cariakun');
    Route::get('/koperasi', [AdminController::class, 'listkoperasi'])->middleware('userAkses:admin,pengawas,kabid')->name('listkoperasi');
    Route::get('/koperasi/tambah', [AdminController::class, 'tambahkoperasi'])->middleware('userAkses:admin')->name('tambahkoperasi');
    Route::post('/koperasi/tambah', [AdminController::class, 'createkoperasi'])->middleware('userAkses:admin')->name('createkoperasi');
    Route::get('/koperasi/edit/{nik}', [AdminController::class, 'editkoperasi'])->middleware('userAkses:admin')->name('editkoperasi');
    Route::post('/koperasi/edit/{nik}', [AdminController::class, 'updatekoperasi'])->middleware('userAkses:admin')->name('updatekoperasi');
    Route::get('/koperasi/hapus/{nik}', [AdminController::class, 'hapuskoperasi'])->middleware('userAkses:admin')->name('hapuskoperasi');
    Route::get('/koperasi/cari', [AdminController::class, 'carikoperasi'])->name('carikoperasi');

    Route::get('/pengurus', [PengurusController::class,'index'])->middleware('userAkses:pengurus')->name('pengurus');
    Route::get('/tindaklanjut', [PengurusController::class, 'listtindaklanjut'])->name('listtindaklanjut');
    Route::get('/tindaklanjut/input/{id_pemeriksaan}', [PengurusController::class, 'inputtindaklanjut'])->middleware('userAkses:pengurus')->name('inputtindaklanjut');
    Route::post('/tindaklanjut/input', [PengurusController::class, 'storetindaklanjut'])->middleware('userAkses:pengurus')->name('storetindaklanjut');
    Route::get('/tindaklanjut/lihat/{id_tindaklanjut}', [PengurusController::class, 'lihattindaklanjut'])->name('lihattindaklanjut');
    Route::get('/tindaklanjut/edit/{id_tindaklanjut}', [PengurusController::class, 'edittindaklanjut'])->middleware('userAkses:pengurus')->name('edittindaklanjut');
    Route::post('/tindaklanjut/edit/{id_tindaklanjut}', [PengurusController::class, 'updatetindaklanjut'])->middleware('userAkses:pengurus')->name('updatetindaklanjut');
    Route::get('/tindaklanjut/hapus/{id_tindaklanjut}', [PengurusController::class, 'hapustindaklanjut'])->middleware('userAkses:pengurus')->name('hapustindaklanjut');
    Route::get('/tindaklanjut/cari', [PengurusController::class, 'caritindaklanjut'])->name('caritindaklanjut');
    Route::get('/pengaduan', [PengurusController::class, 'listpengaduan'])->name('listpengaduan');
    Route::post('/pengaduan/input', [PengurusController::class, 'inputpengaduan'])->middleware('userAkses:pengurus')->name('inputpengaduan');
    Route::post('/pengaduan/edit/{id_pengaduan}', [PengurusController::class, 'updatepengaduan'])->middleware('userAkses:pengurus')->name('updatepengaduan');
    Route::get('/pengaduan/hapus/{id_pengaduan}', [PengurusController::class, 'hapuspengaduan'])->middleware('userAkses:pengurus')->name('hapuspengaduan');
    Route::get('/pengaduan/cari', [PengurusController::class, 'caripengaduan'])->name('caripengaduan');

    //pengawas
    Route::get('/pengawas', [PengawasController::class,'index'])->middleware('userAkses:pengawas')->name('pengawas');
    Route::get('/pemeriksaan', [PengawasController::class, 'listpemeriksaan'])->middleware('userAkses:admin,pengawas,kabid')->name('listperiksa');
    Route::get('/pemeriksaan/input', [PengawasController::class, 'inputperiksa'])->middleware('userAkses:pengawas')->name('inputperiksa');
    Route::post('/pemeriksaan/input', [PengawasController::class, 'storeperiksa'])->middleware('userAkses:pengawas')->name('storeperiksa');
    Route::get('/pemeriksaan/lihat/{id_pemeriksaan}', [PengawasController::class, 'lihatperiksa'])->name('lihatperiksa');
    Route::get('/pemeriksaan/edit/{id_pemeriksaan}', [PengawasController::class, 'editperiksa'])->middleware('userAkses:pengawas')->name('editperiksa');
    Route::post('/pemeriksaan/edit/{id_pemeriksaan}', [PengawasController::class, 'updateperiksa'])->middleware('userAkses:pengawas')->name('updateperiksa');
    Route::get('/pemeriksaan/generate/{id_pemeriksaan}', [PengawasController::class, 'fileperiksa'])->middleware('userAkses:pengawas')->name('fileperiksa');
    Route::post('/pemeriksaan/generate/{id_pemeriksaan}', [PengawasController::class, 'generatefile'])->middleware('userAkses:pengawas')->name('generatefile');
    Route::get('/pemeriksaan/cari', [PengawasController::class, 'cariperiksa'])->middleware('userAkses:admin,pengawas,kabid')->name('cariperiksa');
    Route::post('/respon/input', [PengawasController::class, 'inputrespon'])->middleware('userAkses:pengawas')->name('inputrespon');
    Route::post('/respon/edit/{id_respon}', [PengawasController::class, 'editrespon'])->middleware('userAkses:pengawas')->name('editrespon');
    Route::get('/respon/hapus/{id_respon}', [PengawasController::class, 'hapusrespon'])->middleware('userAkses:pengawas')->name('hapusrespon');
    Route::get('/tindaklanjut/respon/{id_tindaklanjut}', [PengawasController::class, 'respontindaklanjut'])->middleware('userAkses:pengawas')->name('respontindaklanjut');
    Route::post('/tindaklanjut/respon/{id_tindaklanjut}', [PengawasController::class, 'storerespontl'])->middleware('userAkses:pengawas')->name('storerespontl');
    Route::get('/tindaklanjut/edit/respon/{id_tindaklanjut}', [PengawasController::class, 'respontindaklanjut'])->middleware('userAkses:pengawas')->name('editrespontl');
    Route::get('/tindaklanjut/lihat/respon/{id_tindaklanjut}', [PengawasController::class, 'lihatrespontl'])->name('lihatrespontl');

    Route::get('/kabid', [KabidController::class,'index'])->middleware('userAkses:kabid')->name('kabid');
    Route::get('/dashboard/statistics', [KabidController::class, 'getStatisticsApi'])->name('dashboard.statistics');
    Route::get('/dashboard/chart-data', [KabidController::class, 'getChartData'])->name('dashboard.chart-data');

    Route::get('/logout', [SesiController::class,'logout']);
});

