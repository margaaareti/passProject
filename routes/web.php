<?php

use App\Http\Controllers\AdminControllers\AdminController;
use App\Http\Controllers\ApplicationControllers\CarAppController;
use App\Http\Controllers\ApplicationControllers\GuestAppController;
use App\Http\Controllers\ApplicationControllers\PropertyAppController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::prefix('/home')->middleware(['auth', 'verified'])->group(function () {

    Route::get('/card', [HomeController::class, 'email']);

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/applications', [HomeController::class, 'index'])->name('user.app');
    Route::get("/show-applications", [HomeController::class, 'showAllApplications'])->name('user.app.showAllApp');

    Route::post("/guest-application", [GuestAppController::class, 'store'])->name('guest.app.create');
    Route::get("/guest-applications/{id}", [GuestAppController::class, 'showApp'])->name('user.app.showGuestApp');

    Route::post("/car-application", [CarAppController::class, 'store'])->name('carCreate');
    Route::get("/car-applications/{id}", [CarAppController::class, 'showApp'])->name('user.app.showCarApp');

    Route::post("/property-application", [PropertyAppController::class, 'store'])->name('property.app.create');
    Route::get("/property-application/{id}", [PropertyAppController::class, 'showApp'])->name('user.app.showPropertyApp');


    Route::get('/hello', function () {
        return 'Привет';
    })->middleware(['role:admin']);

});

Route::prefix('/admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get("/show-applications", [AdminController::class, 'showAllApplications'])->name('admin.app.showAllApp');
    Route::get("/show-application/{type}/{id}", [AdminController::class, 'showApplication'])->name('admin.app.showApp');
    Route::post("/submit-application/{id}", [AdminController::class, 'approveApplication'])->name('admin.app.approveApp');
    Route::post("/pending-application/{id}", [AdminController::class, 'pendingApplication'])->name('admin.app.pendingApp');

    Route::get("/show-application/{id}", [AdminController::class, 'export'])->name('guests.export');
});

