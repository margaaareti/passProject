<?php

use App\Http\Controllers\ApplicationControllers\CarAppController;
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

    Route::get('/applications', [GuestAppController::class, 'index'])->name('user.app');
    Route::post("/guest-application", [GuestAppController::class, 'store'])->name('user.app.create');
    Route::get("/guest-applications", [GuestAppController::class, 'showAllApp'])->name('user.app.showAllApp');
    Route::get("/guest-applications/{id}", [GuestAppController::class, 'showApp'])->name('user.app.showApp');

    Route::post("/car-application", [CarAppController::class, 'store'])->name('carCreate');


});

Route::get("/application", [CarAppController::class, 'index'])->name('carPage');
Route::post("/car-application", [CarAppController::class, 'store'])->name('carCreate');



//    Route::get('/test-throttle', function (Request $request) {
//        $key = $request->ip();
//        $allowedAttempts = 1; // максимальное количество попыток
//        $decaySeconds = 5; // время ожидания (в секундах) после достижения лимита
//
//        if (RateLimiter::tooManyAttempts($key, $allowedAttempts, $decaySeconds)) {
//            $retryAfter = RateLimiter::availableIn($key);
//
//            return response()->json([
//                'error' => 'Too many requests. Please try again after ' . $retryAfter . ' seconds.',
//            ], Response::HTTP_TOO_MANY_REQUESTS);
//        }
//
//        RateLimiter::hit($key, $decaySeconds);
//
//        return response()->json([
//            'message' => 'Success!',
//        ]);
//    });
//});


