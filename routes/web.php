<?php

use App\Http\Controllers\FormControllers\PeopleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
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

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post("/guest-application", [PeopleController::class, 'store'])->name('user.app.create');
    Route::get("/guest-application/{app}", [PeopleController::class, 'show'])->name('user.app.show');
    Route::get("/test", [TestController::class, 'show'])->name('test.show');
    Route::post("/submit", [TestController::class, 'send'])->name('test.submit');
});


