<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipalitiesController;
use App\Http\Controllers\ProvincesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VisitorsController;
use App\Models\Visitors;
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



Route::get('/visitors', [VisitorsController::class, 'index'])->name('visitor');

Route::post('/store/visitor', [VisitorsController::class, 'store'])->name('store.visitor');

Route::get('/', function () {
    return view('login');
})->name('login.user');

Route::post('/user/login', [LoginController::class, 'loginHandler'])->name('login');

Route::middleware('auth')->group(function(){
   
    Route::get('/Dashboard', [UsersController::class, 'index'])->name('admin.dashboard');

    //province
    Route::get('/Add_Province', [ProvincesController::class, 'index'])->name('province');
    Route::post('/save/province', [ProvincesController::class, 'store'])->name('store.province');

    //municipality
    Route::get('/municipalities', [MunicipalitiesController::class, 'index'])->name('municipality');
    Route::post('/municipalities/store', [MunicipalitiesController::class, 'store'])->name('store.municipality');




    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});