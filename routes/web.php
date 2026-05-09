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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceFaqController;
use App\Http\Controllers\ServiceImageController;
use App\Http\Controllers\ServicePriceController;
use App\Http\Controllers\SiteSettingController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/service', [ServiceController::class, 'frontIndex'])->name('service');
Route::get('/service/{slug}', [ServiceController::class, 'frontShow'])->name('service.show');
Route::get('/contact', [ContactController::class, 'frontIndex'])->name('contact');
Route::get('/testimonial', [TestimonialController::class, 'frontIndex'])->name('testimonial');
Route::get('/project', [ProjectController::class, 'frontIndex'])->name('project');
Route::get('/blog', [BlogController::class, 'frontIndex'])->name('blog');
Route::get('/blog/{slug}', [BlogController::class, 'frontShow'])->name('blog.show');
Route::get('/team', [TeamController::class, 'frontIndex'])->name('team');
Route::get('/about-us', [AboutUsController::class, 'frontIndex'])->name('about-us');



Route::get('/send-email', [TwoStepLoginController::class, 'sendEmail']);
Route::get('/otp', [TwoStepLoginController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp', [TwoStepLoginController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/resend-otp', [TwoStepLoginController::class, 'resend'])->name('otp.resend');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });

    // Category Routes
    Route::resource('categories', CategoryController::class);

    // Service Routes
    Route::resource('services', ServiceController::class);

    // Service FAQ Routes
    Route::resource('service-faqs', ServiceFaqController::class);

    // Service Image Routes
    Route::resource('service-images', ServiceImageController::class);

    // Service Price Routes
    Route::resource('service-prices', ServicePriceController::class);

    // Project Routes
    Route::resource('projects', ProjectController::class);

    // Blog Routes
    Route::resource('blogs', BlogController::class);

    // Testimonial Routes
    Route::resource('testimonials', TestimonialController::class);

    // Team Routes
    Route::resource('teams', TeamController::class);

    // Site Setting Routes
    Route::get('site-settings', [SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

});
