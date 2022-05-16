<?php
namespace App\Http\Controllers;

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
    return redirect()->route('adverts.all');
});

Route::get('/adverts/all', [AdvertController::class, 'index'])->name('adverts.all');
Route::get('/adverts/clothis', [AdvertController::class, 'indexClothis'])->name('adverts.clothis');
Route::get('/adverts/home', [AdvertController::class, 'indexHome'])->name('adverts.home');
Route::get('/adverts/auto', [AdvertController::class, 'indexAuto'])->name('adverts.auto');
Route::get('/adverts/sport', [AdvertController::class, 'indexSport'])->name('adverts.sport');


Route::resource('/adverts', AdvertController::class)->middleware(['auth']);


require __DIR__.'/auth.php';
