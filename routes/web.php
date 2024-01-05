<?php


use App\Models\Jemaat;
use App\Models\KaryawanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoController;
use App\Http\Controllers\SQController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RfqController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;

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

/*Tampilan Awal buka PHP Artisan Serve*/
Route::get('/', function () {
    return redirect()->route("dashboard");
});

// Auth::routes();

Route::get('/dashboard', [DashboardController::class, 'tampilall'])->name('dashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/master', function () {
	return view('layouts/master');
})->name('master');

Route::get('/produk',[ProdukController::class,'produkview'])->name('Produk');
Route::get('/bahan',[ProdukController::class,'bahanview'])->name('Bahan');
Route::get('/produkinput', [ProdukController::class,'produkInput'])->name('ProdukInput');
Route::get('/bahaninput', [ProdukController::class,'bahanInput'])->name('BahanInput');
Route::post('/produkupload',[ProdukController::class,'produkUpload'])->name('UploadProduk');
Route::post('/bahanupload',[ProdukController::class,'bahanUpload'])->name('UploadBahan');
Route::get('/produkedit/{id_produk}', [ProdukController::class,'produkEditView'])->name('ProdukEdit');
Route::get('/bahanedit/{id_produk}', [ProdukController::class,'bahanEditView'])->name('BahanEdit');
Route::put('/produkedit/edit/{id_produk}', [ProdukController::class,'produkUpdate'])->name('ProdukUpdate');
Route::put('/bahanedit/edit/{id_produk}', [ProdukController::class,'bahanUpdate'])->name('BahanUpdate');
Route::delete('/produkdelete/{id_produk}',[ProdukController::class,'Produkdelete'])->name('DeleteProduk');
Route::delete('/bahandelete/{id_produk}',[ProdukController::class,'Bahandelete'])->name('DeleteBahan');

//BOM
Route::get('/bom', [BomController::class,'tampilBom'])->name('tampilBom');
Route::get('/bom-input', [BomController::class,'materialInput'])->name('MasukBOM');
Route::post('/bom/bomMasuk',[BomController::class,'uploadBOM']);
Route::get('/bom/delete/{kode_bom}',[BomController::class,'deletbom']);
Route::get('/bom/item_list/{kode_bom}',[BomController::class,'materialInputItems']);
Route::post('/bom/item_list/upload',[BomController::class,'uploadList']);
Route::get('/bom/delete_item_list/{kode_bom_list}',[BomController::class,'deleteList']);

//MO
Route::get('/mo',[MoController::class,'manufactureOrder'])->name('tampilMO');
Route::post('/mo/upload',[MoController::class,'moUpload'])->name('moUpload');
Route::put('/mo/update/{kode_mo}',[MoController::class,'moUpdate']);
Route::put('/mo/update/produk/{kode_mo}',[MoController::class,'moUpdateProduk']);
Route::get('/mo/update/produk/cek/{kode_mo}',[MoController::class,'caItems']);
Route::post('/mo/produksi/{kode_mo}',[MoController::class,'moProduce']);
Route::post('/mo/produksi/proses/{kode_mo}',[MoController::class,'moProsesProduce']);
Route::delete('/mo/delete/{id}',[MoController::class,'deletemo']);

//vendor
Route::get('/vendor_user',[VendorController::class,'VendorTampil'])->name('Vendor');
Route::get('/vendor_user/input',[VendorController::class,'inputVendorTampil'])->name('inputVendor');
Route::post('/vendor_user/input/proses',[VendorController::class,'inputVendor'])->name('ProsesInputVendor');
Route::get('/vendor_user/edit/tampil/{id}',[VendorController::class,'editVendorTampil']);
Route::put('/vendor_user/edit/upload/{id}',[VendorController::class,'editVendor']);
Route::delete('/vendor/delete/{id}',[VendorController::class,'deleteVendor']);

//user
Route::get('/user',[UserController::class,'UserTampil'])->name('User');
Route::get('/user/input',[UserController::class,'inputUserTampil'])->name('inputUser');
Route::post('/user/input/proses',[UserController::class,'inputUser'])->name('ProsesInputUser');
Route::get('/user/edit/tampil/{id}',[UserController::class,'editUserTampil']);
Route::put('/user/edit/upload/{id}',[UserController::class,'editUser']);
Route::delete('/user/delete/{id}',[UserController::class,'deleteUser']);

//rfq
Route::get('/rfq/data',[RfqController::class,'rfqTampil'])->name('RfqTampil');
Route::get('/rfq/data/input',[RfqController::class,'inputRfqTampil'])->name('InputRfq');
Route::post('/rfq/data/input/proses',[RfqController::class,'InputRFQ']);
Route::get('/rfq/data/list/{id_rfq}',[RfqController::class,'rfqList'])->name('RfqList');
Route::post('/rfq/data/list/proses',[RfqController::class,'ListProses'])->name('ListProses');
Route::post('/rfq/data/list/saveitem/{id_rfq}',[RfqController::class,'rfqSimpanBarang'])->name('RfqListSimpan');
Route::post('/rfq/data/list/Pembayaran/{id_rfq}',[RfqController::class,'rfqPembayaran'])->name('RfqListPembayaran');
Route::post('/rfq/data/list/Pembayaran/confirm/{id_rfq}',[RfqController::class,'rfqConfirmPembayaran'])->name('RfqListPembayaranComfirm');
Route::delete('/rfq/delete/{id_rfq}',[RfqController::class,'rfqDelete']);

//SQ
Route::get('/SQ/data',[SQController::class,'tampilSQ'])->name('sqTampil');
Route::get('/SQ/data/input',[SQController::class,'tampilSQmasuk'])->name('sqTampilMasuk');
Route::post('/SQ/data/input/proses',[SQController::class,'SQProses'])->name('SQProses');
Route::get('/SQ/data/input/list/{id_sq}',[SQController::class,'SQList']);
Route::post('/SQ/data/input/produk/',[SQController::class,'sqUploadItems'])->name('UploadProdukSQ');
Route::get('/SQ/data/list/save/{id_sq}',[SQController::class,'saveItems']);
Route::get('/SQ/data/list/cek/{id_sq}',[SQController::class,'caItems']);
Route::post('/SQ/data/list/ca/{id_sq}',[SQController::class,'salesCreateBill']);
Route::post('/SQ/data/list/bp/{id_sq}',[SQController::class,'confirmBill']);
Route::delete('/SQ/data/hapus/{id_sq}',[SQController::class,'hapusSQ']);
Route::delete('/SQ/data/hapus_list/{id_sq}',[SQController::class,'hapusSQList']);

//akuntan
Route::get('/Akun',[AkunController::class,'AkunTampil'])->name('tampilAkun');
ROute::get('/Akun/SQ',[AkunController::class,'invoice'])->name('invoice');
ROute::post('/Akun/SQ/tanggal/',[AkunController::class,'invoicePertanggal']);
ROute::get('/Akun/RFQ',[AkunController::class,'bill'])->name('bill');
ROute::post('/Akun/RFQ/tanggal',[AkunController::class,'billPertanggal']);

//departement
Route::get('/departement',[DepartementController::class,'DepartementTampil'])->name('Departement');
Route::get('/departement/input',[DepartementController::class,'inputDepartementTampil'])->name('inputDepartement');
Route::post('/departement/input/proses',[DepartementController::class,'inputDepartement'])->name('ProsesInputDepartement');
Route::get('/departement/edit/tampil/{id}',[DepartementController::class,'editDepartementTampil']);
Route::put('/departement/edit/upload/{id}',[DepartementController::class,'editDepartement']);
Route::delete('/departement/delete/{id}',[DepartementController::class,'deleteDepartement']);

//job
Route::get('/job',[JobController::class,'JobTampil'])->name('Job');
Route::get('/job/input',[JobController::class,'inputJobTampil'])->name('inputJob');
Route::post('/job/input/proses',[JobController::class,'inputJob'])->name('ProsesInputJob');
Route::get('/job/edit/tampil/{id}',[JobController::class,'editJobTampil']);
Route::put('/job/edit/upload/{id}',[JobController::class,'editJob']);
Route::delete('/job/delete/{id}',[JobController::class,'deleteJob']);

//karyawan
Route::get('/karyawan',[KaryawanController::class,'KaryawanTampil'])->name('Karyawan');
Route::get('/karyawan/input',[KaryawanController::class,'inputKaryawanTampil'])->name('inputKaryawan');
Route::post('/karyawan/input/proses',[KaryawanController::class,'inputKaryawan'])->name('ProsesInputKaryawan');
Route::get('/karyawan/edit/tampil/{id}',[KaryawanController::class,'editKaryawanTampil']);
Route::put('/karyawan/edit/upload/{id}',[KaryawanController::class,'editKaryawan']);
Route::delete('/karyawan/delete/{id}',[KaryawanController::class,'deleteKaryawan']);
// Route::get('/getDepartementByJobPos/{id}', [KaryawanController::class, 'getDepart']);

