<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\BlogController;



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
  //  return view('backend.default.index');
//});
Route::get('/nedmin', [DefaultController::class, 'index'])->name('nedmin.Index');

Route::namespace('Backend')->group(function(){
   Route::prefix('nedmin/settings')->group(function(){
     Route::get('/', [SettingsController::class, 'index'])->name('settings.Index');
     Route::post('/', [SettingsController::class, 'sortable'])->name('settings.Sortable');
     Route::get('/delete{id}', [SettingsController::class, 'destroy']);
     Route::get('/edit{id}', [SettingsController::class, 'edit'])->name('settings.Edit');
     Route::post('/update/{id}', [SettingsController::class, 'update'])->name('settings.Update');

   });
});


   Route::prefix('nedmin')->group(function(){
        Route::post('/sortable', [BlogController::class, 'sortable'])->name('blog.Sortable');
        Route::resource('blog',BlogController::class);
        


        });
