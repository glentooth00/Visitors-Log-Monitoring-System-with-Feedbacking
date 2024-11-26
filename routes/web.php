<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
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
    return view('login');
});

Route::post('/user/login', [LoginController::class, 'loginHandler'])->name('login');

Route::middleware('auth')->group(function(){
   
    Route::get('/Dashboard', [UsersController::class, 'index'])->name('admin.dashboard');

});