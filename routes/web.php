<?php

use App\Http\Controllers\BarangaysController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MunicipalitiesController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ProvincesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\VisitorController;
use App\Models\Visitors;
use Illuminate\Support\Facades\Route;
use App\Models\Office;
use App\Models\Barangays;
use App\Models\Feedback;
use App\Models\Municipalities;
use App\Models\Provinces;
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

Route::post('/visitors/rating', [VisitorController::class, 'storeVisitor'])->name('store.rating');

Route::get('/visitors', [VisitorsController::class, 'index'])->name('visitor');

Route::post('/store/visitor', [VisitorsController::class, 'store'])->name('store.visitor');

Route::get('/get-municipalities', [VisitorsController::class, 'getMunicipalities'])->name('get.municipalities');

Route::get('/get-barangays', [VisitorsController::class, 'getBarangays'])->name('get.barangays');

//feedbacks
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');


Route::get('/', function () {

    $offices = Office::all();
        $provinces = Provinces::all();
        $municipalities = Municipalities::with('province')->get();
        $barangays = Barangays::with('municipality.province')->get();

    return view('login',[
        'offices' => $offices,
        'provinces' => $provinces,
        'municipalities' => $municipalities,
        'barangays' => $barangays
    ]);
})->name('login.user');

Route::post('/user/login', [LoginController::class, 'loginHandler'])->name('login');


//GROUPS ONLY ACCESSIBLE BY USER ONCE LOGGED IN

//MIDDLWARE- USED TO MANAGE LOGINS OF ADMIN ONLY NEED TO PASS THE USERNAME OR PASSWORD | EMAIL OR PASSWORD

Route::middleware('auth')->group(function () {

    Route::get('/List', [DashboardController::class, 'index'])->name('admin.dashboard');

    //province
    Route::get('/Add_Province', [ProvincesController::class, 'index'])->name('province');
    Route::post('/save/province', [ProvincesController::class, 'store'])->name('store.province');
    Route::put('/provinces/{id}', [ProvincesController::class, 'update'])->name('province.update');
    Route::delete('/provinces/{id}', [ProvincesController::class, 'destroy'])->name('province.destroy');



    //municipality
    Route::get('/municipalities', [MunicipalitiesController::class, 'index'])->name('municipality');
    Route::post('/municipalities/store', [MunicipalitiesController::class, 'store'])->name('store.municipality');
    Route::get('municipalities/{municipality}/edit', [MunicipalitiesController::class, 'edit'])->name('municipalities.edit');
    Route::put('municipalities/{id}', [MunicipalitiesController::class, 'update'])->name('municipalities.update');
    Route::delete('municipalities/{municipality}', [MunicipalitiesController::class, 'destroy'])->name('municipalities.destroy');

    //barangays
    Route::get('/Barangays', [BarangaysController::class, 'index'])->name('barangays');
    Route::post('/Barangays/Store', [BarangaysController::class, 'store'])->name('store.barangay');
    Route::put('/barangays/{barangay}', [BarangaysController::class, 'update'])->name('barangays.update');
    Route::delete('/barangays/{id}', [BarangaysController::class, 'destroy'])->name('barangays.destroy');




    //office
    Route::get('/Office', [OfficeController::class, 'index'])->name('office');
    Route::post('/Office/create', [OfficeController::class, 'store'])->name('store.office');

    //visitor display page
    Route::get('/visitors/display', [VisitorsController::class, 'displayPage'])->name('visitor.view');

    //changepassword
    Route::get('/users', [UsersController::class, 'index'])->name('change_password');
    // In routes/web.php

    Route::put('/change-password/{user}', [UsersController::class, 'update'])->name('users.update');


    Route::post('/submit-feedback', [FeedbackController::class, 'submitFeedback'])->name('submit.feedback');

    Route::get('/view-feedback', [FeedbackController::class, 'index'])->name('feedback.view');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});
