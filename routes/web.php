<?php

use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('pages.index');
// });

Route::get('/',[HomeController::class,'index'])->name('home');

// routes/web.php
Route::get('/get-cities/{id}', [HomeController::class, 'getCitiesByCountryId']);
//  submit route
Route::post('/submitdata', [HomeController::class, 'submitForm'])->name('submitdata');
