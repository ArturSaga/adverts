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
    return redirect('/adverts/category/all');
});

Route::get('/adverts/category/{all}', [AdvertController::class, 'index'])->name('adverts.all');
Route::get('/adverts', function () {
    return redirect('/adverts/category/all');
});
Route::resource('/adverts', AdvertController::class)->middleware(['auth']);

Route::prefix('/admin')->group(function () {
    Route::get('/', [AdminController::class, 'getAdverts'])->name('admin');
    Route::resource('users', AdminController::class)->middleware(['auth']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
