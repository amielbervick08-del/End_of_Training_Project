<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SkillExchangeController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RequestOfferController;
use App\Http\Controllers\LearningRequestController;
use App\Http\Controllers\UserSkillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/requests/{learningRequest}/offer', [RequestOfferController::class, 'store'])
        ->name('requests.offer');

    Route::get(
        '/request-offers/{requestOffer}/book',
        [BookingController::class, 'create']
    )->name('bookings.create');

    Route::post(
        '/request-offers/{requestOffer}/book',
        [BookingController::class, 'store']
    )->name('bookings.store');

    Route::patch(
        '/bookings/{booking}/accept',
        [BookingController::class, 'accept']
    )->name('bookings.accept');

    Route::patch('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])
        ->name('bookings.confirm');

    Route::patch('/bookings/{booking}/complete', [BookingController::class, 'complete'])
        ->name('bookings.complete');

    Route::get('/bookings/{booking}/review', [ReviewController::class, 'create'])
        ->name('reviews.create');

    Route::post('/bookings/{booking}/review', [ReviewController::class, 'store'])
        ->name('reviews.store');

    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

    Route::get('/tutors', [TutorController::class, 'index'])->name('tutors.index');

    Route::get('/tutors/{tutor}', [TutorController::class, 'show'])->name('tutors.show');

    Route::get('/availability', [AvailabilityController::class, 'index'])
        ->name('availability.index');

    Route::post('/availability', [AvailabilityController::class, 'store'])
        ->name('availability.store');

    Route::delete('/availability/{availability}', [AvailabilityController::class, 'destroy'])
        ->name('availability.destroy');

    Route::get('/skill-exchanges', [SkillExchangeController::class, 'index'])
        ->name('skill-exchanges.index');

    Route::post('/skill-exchanges', [SkillExchangeController::class, 'store'])
        ->name('skill-exchanges.store');

    Route::patch('/skill-exchanges/{skillExchange}/accept', [SkillExchangeController::class, 'accept'])
        ->name('skill-exchanges.accept');

    Route::patch('/skill-exchanges/{skillExchange}/decline', [SkillExchangeController::class, 'decline'])
        ->name('skill-exchanges.decline');

    Route::get('/messages', [MessageController::class, 'index'])
        ->name('messages.index');

    Route::get('/messages/{user}', [MessageController::class, 'show'])
        ->name('messages.show');

    Route::post('/messages/{user}', [MessageController::class, 'store'])
        ->name('messages.store');

    Route::get('/skills', [SkillController::class, 'index'])
        ->name('skills.browse');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::patch('/notifications/{notification}/read', [NotificationController::class, 'read'])
        ->name('notifications.read');

    Route::patch('/notifications/read-all', [NotificationController::class, 'readAll'])
        ->name('notifications.read-all');
});
Route::patch('/requests/{learningRequest}/cancel', [LearningRequestController::class, 'cancel'])
    ->name('requests.cancel');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
require __DIR__ . '/auth.php';
Route::middleware('auth')->group(function () {
    Route::get('/my-skills', [UserSkillController::class, 'index'])
        ->name('skills.index');

    Route::post('/my-skills', [UserSkillController::class, 'store'])
        ->name('skills.store');

    Route::delete('/my-skills/{userSkill}', [UserSkillController::class, 'destroy'])
        ->name('skills.destroy');
    Route::get('/requests', [LearningRequestController::class, 'index'])
        ->name('requests.index');

    Route::get('/browse-requests', [LearningRequestController::class, 'browse'])
        ->name('requests.browse');

    Route::get('/requests/create', [LearningRequestController::class, 'create'])
        ->name('requests.create');

    Route::post('/requests', [LearningRequestController::class, 'store'])
        ->name('requests.store');

    Route::get('/requests/{learningRequest}/edit', [LearningRequestController::class, 'edit'])
        ->name('requests.edit');

    Route::put('/requests/{learningRequest}', [LearningRequestController::class, 'update'])
        ->name('requests.update');

    Route::get('/requests/{learningRequest}', [LearningRequestController::class, 'show'])
        ->name('requests.show');
    Route::patch(
        '/request-offers/{requestOffer}/accept',
        [RequestOfferController::class, 'accept']
    )->name('requests.offer.accept');

    Route::patch(
        '/request-offers/{requestOffer}/decline',
        [RequestOfferController::class, 'decline']
    )->name('requests.offer.decline');
});
