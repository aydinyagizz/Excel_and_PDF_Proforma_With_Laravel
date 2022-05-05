<?php

use App\Http\Controllers\FaturaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\TeklifController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
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


Route::prefix('/')->middleware('auth')->group(function () {

    Route::get('', [IndexController::class, 'index'])->name('admin.index');

    Route::get('logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('register', [UsersController::class, 'register'])->name('register');
    Route::post('register', [UsersController::class, 'registerUser'])->name('register');


    Route::get('teklifListele', [TeklifController::class, 'teklifListele'])->name('admin.teklifListele');
    Route::match(['get', 'post'], 'teklifEkle/{id?}', [TeklifController::class, 'teklifEkle'])->name('admin.teklifAdd');
    Route::get('teklifDelete/{id}', [TeklifController::class, 'teklifDelete'])->name('admin.teklifDelete');
    Route::get('teklifEdit/{id?}', [TeklifController::class, 'teklifEdit'])->name('admin.teklifEdit');
    Route::post('teklifEdit', [TeklifController::class, 'teklifUpdate'])->name('admin.teklifUpdate');
    //Route::post('teklifEkle/{id?}', [TeklifController::class, 'teklifEkle'])->name('admin.teklifEkle');
    Route::get('teklifEkleList/{id?}', [TeklifController::class, 'teklifEkleList'])->name('admin.teklifEkle');


    Route::match(['get', 'post'],'urunEkle', [ProductsController::class, 'urunEkle'])->name('admin.urunEkle');
    Route::post('urunEdit', [ProductsController::class, 'urunUpdate'])->name('admin.urunUpdate');
    Route::get('urunEdit/{id?}', [ProductsController::class, 'urunEdit'])->name('admin.urunEdit');
    Route::get('urunDelete/{id}', [ProductsController::class, 'urunDelete'])->name('admin.urunDelete');


    Route::get('faturaListele', [FaturaController::class, 'faturaListele'])->name('admin.faturaListele');
    Route::post('faturaDetayGetir', [FaturaController::class, 'faturaDetayGetir'])->name('admin.faturaDetayGetir');
    Route::get('faturaEkle', [FaturaController::class, 'faturaEkle'])->name('admin.faturaEkle');
    Route::post('faturaAdd', [FaturaController::class, 'faturaAdd'])->name('admin.faturaAdd');
    Route::get('faturaDelete/{id}', [FaturaController::class, 'faturaDelete'])->name('admin.faturaDelete');
    Route::get('faturaEdit/{id?}', [FaturaController::class, 'faturaEdit'])->name('admin.faturaEdit');
    Route::post('faturaEdit', [FaturaController::class, 'faturaUpdate'])->name('admin.faturaUpdate');
    Route::post('yuzdeEkle/{id}', [FaturaController::class, 'yuzdeEkle'])->name('admin.yuzdeEkle');


    Route::get('teklifPdf/{id}', [TeklifController::class, 'teklifPdf'])->name('admin.teklifPdf');
    Route::get('pdfDownload/{id}', [TeklifController::class, 'pdfDownload']);
    //   Route::get('/teklif/create-pdf/{id}', [TeklifController::class, 'exportPDF']);

    Route::match(['get', 'post'],'userList/{id?}', [UsersController::class, 'userList'])->name('admin.userList')->middleware('role:Admin');
    Route::get('userDelete/{id}', [UsersController::class, 'userDelete'])->name('admin.userDelete');
    Route::match(['get', 'post'],'userEdit/{id?}', [UsersController::class, 'userEdit'])->name('admin.userEdit');
    Route::match(['get', 'post'],'userUpdate/{id?}', [UsersController::class, 'userUpdate'])->name('admin.userUpdate');

    Route::get('home', [IndexController::class, 'home'])->name('admin.home');
    Route::get('export/{id}', [IndexController::class, 'export'])->name('admin.export');
    //  Route::get('storage', [IndexController::class, 'storage'])->name('admin.storage');
    Route::post('import', [IndexController::class, 'import'])->name('admin.import');



});


//Route::get('login', function (){
//    return view('pages.login');
//});
