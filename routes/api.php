<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\TreeApiController;
use App\Http\Controllers\Api\AdoptionApiController;
use App\Http\Controllers\Api\SponsorshipApiController;

Route::middleware('api')->group(function () {
    // Public routes
    Route::post('/auth/register', [AuthApiController::class, 'register']);
    Route::post('/auth/login', [AuthApiController::class, 'login']);

    // Trees
    Route::get('/trees', [TreeApiController::class, 'index']);
    Route::get('/trees/{tree}', [TreeApiController::class, 'show']);
    Route::get('/trees/map/data', [TreeApiController::class, 'mapData']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthApiController::class, 'logout']);
        Route::get('/auth/profile', [AuthApiController::class, 'profile']);

        // Adoptions
        Route::post('/trees/{tree}/adopt', [AdoptionApiController::class, 'store']);
        Route::get('/adoptions/my-adoptions', [AdoptionApiController::class, 'myAdoptions']);
        Route::get('/adoptions/impact-summary', [AdoptionApiController::class, 'getImpactSummary']);

        // Sponsorships
        Route::post('/trees/{tree}/sponsor', [SponsorshipApiController::class, 'store']);
        Route::post('/sponsorships/{sponsorship}/process', [SponsorshipApiController::class, 'processPayment']);
        Route::get('/sponsorships/my-sponsorships', [SponsorshipApiController::class, 'mySponsorships']);
    });
});
