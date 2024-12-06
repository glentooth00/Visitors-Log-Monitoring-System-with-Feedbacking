<?php

use App\Http\Controllers\BarangaysController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashbooardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipalitiesController;
use App\Http\Controllers\OfficeController;
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

Route::get('/get-municipalities', [VisitorsController::class, 'getMunicipalities'])->name('get.municipalities');

Route::get('/get-barangays', [VisitorsController::class, 'getBarangays'])->name('get.barangays');

//feedbacks
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');


Route::get('/', function () {
    return view('login');
})->name('login.user');

Route::post('/user/login', [LoginController::class, 'loginHandler'])->name('login');


//GROUPS ONLY ACCESSIBLE BY USER ONCE LOGGED IN

//MIDDLWARE- USED TO MANAGE LOGINS OF ADMIN ONLY NEED TO PASS THE USERNAME OR PASSWORD | EMAIL OR PASSWORD

Route::middleware('auth')->group(function () {

    Route::get('/List', [DashboardController::class, 'index'])->name('admin.dashboard');

    //province
    Route::get('/Add_Province', [ProvincesController::class, 'index'])->name('province');
    Route::post('/save/province', [ProvincesController::class, 'store'])->name('store.province');

    //municipality
    Route::get('/municipalities', [MunicipalitiesController::class, 'index'])->name('municipality');
    Route::post('/municipalities/store', [MunicipalitiesController::class, 'store'])->name('store.municipality');

    //barangays
    Route::get('/Barangays', [BarangaysController::class, 'index'])->name('barangays');
    Route::post('/Barangays/Store', [BarangaysController::class, 'store'])->name('store.barangay');

    //office
    Route::get('/Office', [OfficeController::class, 'index'])->name('office');
    Route::post('/Office/create', [OfficeController::class, 'store'])->name('store.office');

    //visitor display page
    Route::get('/visitors/display', [VisitorsController::class, 'displayPage'])->name('visitor.view');

    //changepassword
    Route::get('/users', [UsersController::class, 'index'])->name('change_password');
    // In routes/web.php

    Route::put('/change-password/{user}', [UsersController::class, 'update'])->name('users.update');






    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});