<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HandoverController;
use App\Http\Controllers\ChecklistController;

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
})->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function(){
    Route::get('/home', function () {
        return view('home');
    });
    Route::resource('sop', SopController::class);
    //Route::get('download/{filename}', 'SopController@download')->name('download');
    Route::get('download-pdf/{filename}', [SopController::class, 'download'])->name('download.pdf');
    Route::get('/download-pdf', function () {
        return Storage::download('tutorial.pdf');
    });
  
    
    //Route::get('get/{sop}', [SopController::class, 'downloadFile']);
    //Route::get('sop/{filename}',[SopController::class,'download'])->name('sop.download');
    //Route::post('download', [SopController::class, 'download'])->name('download');
    //Route::post('/download/{sop}', [SopController::class, 'download']);
    //Route::get('/download/{file}',[PageController::class,'download']);
    
    //Route::get('download/{id}', [SopController::class, 'downloadFile'])->name('sop.download');
    //Route::get('/sop/search' ,[SopController::class, 'search']);
    //Route::resource('karyawan', KaryawanController::class)->middleware('auth');
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('user', UserController::class);
    Route::resource('about', AboutController::class);
    Route::resource('handover', HandoverController::class);
    Route::resource('checklist', ChecklistController::class);
    Route::get('/checklist/create-folder', [ChecklistController::class, 'createFolder'])->name('checklist.create-folder');
    Route::post('/checklist/store-folder', [ChecklistController::class, 'storeFolder'])->name('checklist.store-folder');
    // Route::post('/handover', [HandoverController::class, 'store'])->name('handover.store');
    // // routes/web.php

Route::post('/handover/save', [HandoverController::class, 'save'])->name('handover.save');

    // Route::get('/', 'WeatherController@index');
    //Route::get('test', 'TestController@index');
});


Route::middleware(['web'])->group(function () {
    Route::get('/force-logout', function () {
        Auth::logout();
        return redirect('/'); // Redirect ke halaman awal atau halaman manapun yang Anda inginkan
    });

});    



//Route::get('/sop', function () {
    //return view('sop');
//});

//Route::get('/karyawans', function () {
    //return view('karyawans.index');
//});

//Route::get('sop', [SopController::class, 'index']);
//Route::get('karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
//Route::get('karyawan/create', [KaryawanController::class, 'create'])->name('karyawan.index');
//Route::post('karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
//Route::get('karyawan/{id}/edit', [KaryawanController::class, 'edit'])->name('karyawan.edit');
//Route::put('karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
//Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');







