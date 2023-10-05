<?php

use App\Http\Controllers\PageCourseDetailsController;
use App\Http\Controllers\PageDashboardController;
use App\Http\Controllers\PageHomeController;
use App\Http\Controllers\PageVideosController;
use App\Http\Controllers\PaymentController;
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

Route::get('/', PageHomeController::class)->name('pages.home');

Route::get('/course/{course:slug}', PageCourseDetailsController::class)
    ->name('pages.course-details');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', PageDashboardController::class)->name('pages.dashboard');
    Route::get('videos/{course:slug}/{video:slug?}', PageVideosController::class)
        ->name('pages.course-videos');
});

Route::webhooks('webhooks');

Route::get('/pay', function () {
    return view('pay');
});
Route::post('/pay', [PaymentController::class, 'payment'])->name('pay');
