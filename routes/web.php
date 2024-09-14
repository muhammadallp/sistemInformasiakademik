<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasPostController;
use App\Http\Controllers\WalikelasController;
use App\Http\Controllers\JadwalMapelController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\PertemuanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// auth
Route::get('/', [HomeController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [loginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/loginadmin', [loginController::class, 'loginadmin']);
Route::post('/proseslogin', [loginController::class, 'authenticate']);
Route::post('/logout', [loginController::class, 'logout']);


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Data Kelas
Route::get('/kelas', [KelasPostController::class, 'index']);
Route::resource('/kelas', KelasPostController::class);
Route::get('/kelas/posts/checkSlug',[KelasPostController::class, 'checkSlug']);


Route::get('/pertemuan', [PertemuanController::class, 'index']);
Route::resource('/pertemuan', PertemuanController::class);

// data mata pelajaran
Route::get('/mapel', [MapelController::class, 'index']);
Route::resource('/mapel', MapelController::class);
Route::get('/mapel/posts/checkSlug',[MapelController::class, 'checkSlug']);

// data jadwal mapel
Route::get('/jadwalmapel', [JadwalMapelController::class, 'index']);
Route::resource('/jadwalmapel', JadwalMapelController::class);
Route::get('/jadwalmapel/posts/checkSlug',[JadwalMapelController::class, 'checkSlug']);

// data guru
Route::get('/guru', [GuruController::class, 'index']);
Route::resource('/guru', GuruController::class);
Route::get('/laporan-data-guru',[GuruController::class,'search']);
Route::get('/laporan-guru',[GuruController::class,'laporan']);
Route::get('/view-pdf',[GuruController::class, 'view_pdf']);
Route::get('/guru/posts/checkSlug',[GuruController::class, 'checkSlug']);

// tahun akademik
Route::get('/tahunakademik', [TahunAkademikController::class, 'index']);
Route::resource('/tahunakademik', TahunAkademikController::class);
Route::get('/tahunakademik/posts/checkSlug',[TahunAkademikController::class, 'checkSlug']);

// data siswa
Route::get('/siswa', [SiswaController::class, 'index']);
Route::get('/siswanilaiuts', [SiswaController::class, 'nilaiuts']);
Route::get('/siswanilaiuas', [SiswaController::class, 'nilaiuas']);
Route::resource('/siswa', SiswaController::class);
Route::get('/siswa/posts/checkSlug',[SiswaController::class, 'checkSlug']);
Route::get('/siswa/posts/daftarmapel',[SiswaController::class, 'daftarmapel']);
Route::get('/laporan-data-siswa',[SiswaController::class,'search']);
Route::get('/laporan-siswa',[SiswaController::class,'laporan']);
Route::get('/viewpdf',[SiswaController::class, 'viewpdf']);
Route::get('/laporan-nilai',[SiswaController::class,'laporannilai']);
Route::get('/laporan-nilaiuas',[SiswaController::class,'laporannilaiuas']);

// nilai
Route::get('/nilai', [NilaiController::class, 'index']);
Route::get('/nilaiuas', [NilaiController::class, 'nilaiuas']);
Route::resource('/nilai', NilaiController::class);
Route::get('/nilai/posts/checkSlug',[NilaiController::class, 'checkSlug']);
Route::get('/nilaiujian/{slug}',  [JadwalMapelController::class, 'someMethod']);

// walikelas
Route::get('/walikelas', [WalikelasController::class, 'index']);
Route::resource('/walikelas', WalikelasController::class);
Route::get('/datasiswa', [WalikelasController::class, 'datasiswa']);

// absen
Route::get('/absensi', [AbsensiController::class, 'index']);
Route::resource('/absensi', AbsensiController::class);
Route::get('/absensisiswa/{slug}/{id}',  [AbsensiController::class, 'someMethod']);
Route::get('/datapertemuan/{slug}',  [AbsensiController::class, 'pertemuan']);
Route::get('/detailabsensisiswa/{slug}',  [AbsensiController::class, 'detailabsen']);
Route::get('/absensiswa', [AbsensiController::class, 'absensiswa']);

// laport

Route::get('/nilairaport', [RaportController::class, 'index']);
Route::resource('/nilairaport', RaportController::class);
Route::get('/detailnilairaport/{slug}', [RaportController::class, 'detailnilairaport']);

Route::get('/raport',[RaportController::class,'search']);
Route::get('/laporan-raport',[RaportController::class,'laporan']);
Route::get('/vieraport',[RaportController::class, 'viewpdf']);
Route::get('/cetak-raport',[RaportController::class, 'cetakraport']);
Route::get('/cetakmapel',[SiswaController::class,'laporanmapel']);


// users
Route::get('/users', [UsersController::class, 'index']);
Route::resource('/users', UsersController::class);


