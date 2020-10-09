<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Posts;
use App\Http\Livewire\Matakuliahs;
use App\Http\Livewire\Nilais;

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
    return view('welcome');
});
Route::get('/posts', Posts::class);

Route::get('/matakuliahs', Matakuliahs::class);

Route::get('/nilais',Nilais::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');