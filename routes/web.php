<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TwoStepLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutUsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/service', [ServiceController::class, 'index'])->name('service');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/testimonial', [TestimonialController::class, 'index'])->name('testimonial');
Route::get('/project', [ProjectController::class, 'index'])->name('project');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us');



Route::get('/send-email', [TwoStepLoginController::class, 'sendEmail']);
Route::get('/otp', [TwoStepLoginController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp', [TwoStepLoginController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/resend-otp', [TwoStepLoginController::class, 'resend'])->name('otp.resend');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });

});
