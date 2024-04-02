<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminViewController;
use App\Http\Controllers\admin\AdminAuthController;

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

Route::get('/', function () {
    return view('welcome');
});


// Admin Routes

Route::get('login', [AdminAuthController::class,'login'])->name('login');
Route::post('admin-logged', [AdminAuthController::class,'logged'])->name('admin.logged');
Route::get('logout', [AdminAuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function() {
    Route::get('dashboard', [AdminViewController::class,'dashboard'])->name('dashboard');
    
});