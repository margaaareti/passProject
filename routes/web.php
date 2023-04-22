<?php

use App\Http\Controllers\ApplicationControllers\GuestAppController;
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

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post("/guest-application", [GuestAppController::class, 'store'])->name('user.app.create');
    Route::get("/guest-application/{app}", [GuestAppController::class, 'show'])->name('user.app.show');
});


