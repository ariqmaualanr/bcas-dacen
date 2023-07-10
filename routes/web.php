<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SopController;

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

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/', function () {
    return view('home');
});

//Route::get('/sop', function () {
    //return view('sop');
//});

//Route::get('/karyawans', function () {
    //return view('karyawans.index');
//});

Route::get('sop', [SopController::class, 'index']);
Route::get('karyawan', [KaryawanController::class, 'index']);
Route::get('karyawan/create', [KaryawanController::class, 'create']);
Route::post('karyawan', [KaryawanController::class, 'store']);

//Route::get('test', 'TestController@index');


Route::get('/dashboard', function () {
    return view('dashboard');    
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
