<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmidaController;

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

Route::get('/', [AmidaController::class, 'index']);
Route::get('/create', [AmidaController::class, 'create'])->name('create');
Route::post('/create',[AmidaController::class, 'store'])->name('store');
Route::get('/{user}', [AmidaController::class, 'showAmida'])->name('show');
Route::post('/{user}/register', [AmidaController::class, 'storePlayerName'])->name('register');
Route::get('/{user}/summary', [AmidaController::class, 'aggregateResult'])->name('summary');