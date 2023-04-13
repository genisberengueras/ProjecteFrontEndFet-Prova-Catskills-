<?php

use App\Http\Controllers\MainControler;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',[MainControler::class,'index'])->name('inici');
Route::get('/embassaments',[MainControler::class,'embassaments'])->name('emb');
Route::get('/comarques',[MainControler::class,'comarques'])->name('com');
Route::get('/quiz',[MainControler::class,'quiz'])->name('quiz');
