<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//sewer
Route::get('/sewer', [App\Http\Controllers\sewer_controller::class, 'index_sewer'])->name('sewer');
Route::post('/sewer/tambah',[App\Http\Controllers\sewer_controller::class, 'tambah_sewer']);
Route::get('editsewer/{id_sewer}',[App\Http\Controllers\sewer_controller::class, 'findidsewer'])->name('editsewer');
Route::get('/deletesewer/{id_sewer}',[App\Http\Controllers\sewer_controller::class, 'deletesewer']);
Route::get('/akunprofil/{id_sewer}', [App\Http\Controllers\sewer_controller::class, 'index_akun'])->name('sewer');

//gaji_sewer
Route::get('/detailgaji_sewer',[App\Http\Controllers\sewer_controller::class,'index_gaji']);
Route::get('/penggajian', [App\Http\Controllers\gaji_controller::class, 'index_gaji'])->name('penggajian');
Route::post('/penggajian/tambah',[App\Http\Controllers\gaji_controller::class, 'tambah_gaji']);
Route::get('/editgaji/{id_gaji}',[App\Http\Controllers\gaji_controller::class, 'findidgaji'])->name('editgaji');
Route::get('/deletegaji/{id_gaji}',[App\Http\Controllers\gaji_controller::class, 'deletegaji']);

//pemasukan
Route::get('/pemasukkan', [App\Http\Controllers\pemasukan_controller::class, 'index_pemasukan'])->name('pemasukan');
Route::post('/pemasukkan/tambah',[App\Http\Controllers\pemasukan_controller::class, 'tambah_pemasukan']);
Route::get('/editpemasukkan/{id_pemasukkan}',[App\Http\Controllers\pemasukan_controller::class, 'findidpemasukkan'])->name('editpemasukkan');
Route::get('/deletepemasukkan/{id_pemasukkan}',[App\Http\Controllers\pemasukan_controller::class, 'deletepemasukkan']);

//pengeluaran
Route::get('/pengeluaran', [App\Http\Controllers\pengeluaran_controller::class, 'index_pengeluaran'])->name('pengeluaran');
Route::post('/pengeluaran/tambah',[App\Http\Controllers\pengeluaran_controller::class, 'tambah_pengeluaran']);
Route::get('/editpengeluaran/{id_pengeluaran}',[App\Http\Controllers\pengeluaran_controller::class, 'findidpengeluaran'])->name('editpengeluaran');
Route::get('/deletepengeluaran/{id_pengeluaran}',[App\Http\Controllers\pengeluaran_controller::class, 'deletepengeluaran']);

//Jurnal Umum
Route::get('/proses/jurnal', [App\Http\Controllers\jurnal_Controller::class, 'jurnal_umum'])->name('jurnal_umum');
Route::get('/Jurnal_umum', [App\Http\Controllers\jurnal_Controller::class, 'jurnal'])->name('jurnal');

//Buku Besar
Route::get('/bukubesar', [App\Http\Controllers\jurnal_Controller::class, 'bukubesar']);

//Dashboard
Route::get('/Admin_Amoora', [App\Http\Controllers\dashboard_Controller::class, 'index_dashboard'])->name('index_admin');

//Login
Route::get('/LoginAdmin', [App\Http\Controllers\dashboard_Controller::class, 'index_dashboard'])->name('loginadmin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Laba Rugi
Route::get('/labarugi/{bln}/{year}', [App\Http\Controllers\jurnal_Controller::class, 'labarugi']);

//Generate PDF pengeluaran
Route::get('generate-pdf', [PDFController::class, 'generatePDF']);
route::get('/downloadPDF/kewajibanpdf',[App\Http\Controllers\pengeluaran_controller::class, 'download_pengeluarankewajiban'])->name('downloadpdf_kewajiban');
route::get('/downloadPDF/produksipdf',[App\Http\Controllers\pengeluaran_controller::class, 'download_pengeluaranproduksi'])->name('downloadpdf_produksi');
route::get('/downloadPDF/customerpdf',[App\Http\Controllers\pengeluaran_controller::class, 'download_pengeluarancust'])->name('downloadpdf_customer');

//Generate PDF pemasukkann
route::get('/downloadPDF/pemasukanpdf',[App\Http\Controllers\pemasukan_controller::class, 'download_pemasukan'])->name('downloadpdf_pemasukan');

//Delete 
Route::get('/deletepemasukan/{id_pemasukan}',[App\Http\Controllers\pemasukan_controller::class, 'delete_pemasukan']);
Route::get('/deletepengeluaran/{id_pengeluaran}',[App\Http\Controllers\pengeluaran_controller::class, 'delete_pengeluaran']);
