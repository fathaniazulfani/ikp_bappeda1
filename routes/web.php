<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\IKPController;
use App\Http\Controllers\ItemController;

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

Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/modal', function () {
    return view('layout.modal');
});

Route::group(['middleware'=>['auth', 'ceklevel:admin,user,user1']], function(){
    
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/_ikp', [IKPController::class, 'index'])->name('_ikp');
    Route::post('/_ikp', [IKPController::class, 'store']);

    //Cetak PDF dan Excel
    Route::get('/cetak_ikp/{nama}/{tahun}', [IKPController::class, 'cetak']);
    // Route::get('/ikp/export_excel/{tahun}', [IKPController::class, 'export_excel']);
    
    //ITEM PENILAIAN
    //Menampilkan form item
    Route::get('/item/{id}', [ItemController::class, 'index']);

    //Menampilkan detail item
    Route::get('/detail_item/{id}', [ItemController::class, 'show']);

    //Input Variabel oleh Admin
    Route::post('/item/input-var/{id}', [ItemController::class, 'store']);
    //Input, update nilai untuk item
    Route::post('/item/input/{id}', [ItemController::class, 'store1']);
    Route::post('/item/upload_file/{id}', [ItemController::class, 'store_file']);
    Route::post('/item/update_file/{id}', [ItemController::class, 'update_file']);
    Route::post('/item/edit/{id}', [ItemController::class, 'update']);
    Route::get('/program/{item}/{id}', [ItemController::class, 'form_program']);
    Route::post('/program/{id}', [ItemController::class, 'store_selaras']);    
    Route::post('/program_update/{id}', [ItemController::class, 'update_selaras']);    

    //Download File Evidence
    Route::get('/download/{file}', [ItemController::class, 'download'])->name('download');
    Route::get('/hapus_file/{id}/{nama}', [ItemController::class, 'hapus_file'])->name('hapus_file');
        
    Route::get('/item-ajax/{id}', 'ItemController@get_value');
});

