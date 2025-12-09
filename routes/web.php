<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\SponsorshipController;
use App\Http\Controllers\AdminController;

// Public pages
Route::get('/', function () {
    return view('home');
});

Route::get('/choose', function () {
    return view('choose');
});

Route::get('/adopt-sponsor', function () {
    return view('adopt_sponsor');
});

Route::get('/track', function () {
    return view('track');
});

Route::get('/partners', function () {
    return view('partners');
});

Route::get('/insights', function () {
    return view('insights');
});

Route::get('/rewards', function () {
    return view('rewards');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/admin/login', [AuthController::class, 'showAdminLogin']);
Route::post('/admin/login', [AuthController::class, 'adminLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

// User Dashboard
Route::get('/dashboard', [DashboardController::class, 'user']);

// Tree Routes
Route::get('/trees', [TreeController::class, 'index'])->name('trees.index');
Route::get('/trees/{tree}', [TreeController::class, 'show'])->name('trees.show');
Route::get('/trees/map', [TreeController::class, 'map'])->name('trees.map');
Route::get('/api/trees/map-data', [TreeController::class, 'getMapData'])->name('api.trees.map');

// Admin Tree Management (admin-only)
Route::middleware(['web', \App\Http\Middleware\EnsureAdmin::class])->group(function () {
    Route::get('/admin/trees/create', [TreeController::class, 'create'])->name('trees.create');
    Route::post('/admin/trees', [TreeController::class, 'store'])->name('trees.store');
    Route::get('/admin/trees/{tree}/edit', [TreeController::class, 'edit'])->name('trees.edit');
    Route::put('/admin/trees/{tree}', [TreeController::class, 'update'])->name('trees.update');
    Route::delete('/admin/trees/{tree}', [TreeController::class, 'destroy'])->name('trees.destroy');
    Route::post('/admin/trees/{tree}/photo', [TreeController::class, 'uploadPhoto'])->name('trees.photo');
});

// Adoption Routes
Route::post('/trees/{tree}/adopt', [AdoptionController::class, 'adopt'])->name('adoptions.store');
Route::get('/my-adoptions', [AdoptionController::class, 'myAdoptions'])->name('adoptions.my');
Route::post('/adoptions/{adoption}/transfer', [AdoptionController::class, 'transfer'])->name('adoptions.transfer');
Route::post('/adoptions/{adoption}/cancel', [AdoptionController::class, 'cancel'])->name('adoptions.cancel');

// Sponsorship Routes
Route::get('/trees/{tree}/sponsor', [SponsorshipController::class, 'create'])->name('sponsorships.create');
Route::post('/trees/{tree}/sponsor', [SponsorshipController::class, 'store'])->name('sponsorships.store');
Route::get('/sponsorships/{sponsorship}/payment', [SponsorshipController::class, 'payment'])->name('sponsorships.payment');
Route::post('/sponsorships/{sponsorship}/process', [SponsorshipController::class, 'processPayment'])->name('sponsorships.process');
Route::get('/sponsorships/{sponsorship}/receipt', [SponsorshipController::class, 'receipt'])->name('sponsorships.receipt');
Route::get('/my-sponsorships', [SponsorshipController::class, 'mySponsorships'])->name('sponsorships.my');

// Admin Dashboard
Route::get('/admin', [DashboardController::class, 'admin']);
Route::get('/admin/sponsorships', [SponsorshipController::class, 'adminIndex'])->name('admin.sponsorships');

// Admin Routes
Route::middleware('web')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/activity-logs', [AdminController::class, 'activityLogs'])->name('admin.activity-logs');
});
