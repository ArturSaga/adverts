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

Route::get('/admin', [AdminController::class, 'getAdverts'])->name('admin');
Route::get('/admin/users', [AdminController::class, 'getUsers'])->name('admin.users');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUsers'])->name('admin.users.edit');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUsers'])->name('admin.users.destroy');
Route::put('/admin/users/{user}', [AdminController::class,'updateUsers'])->name('admin.users.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
