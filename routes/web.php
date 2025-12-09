<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/admin/login', [AuthController::class, 'showAdminLogin']);
Route::post('/admin/login', [AuthController::class, 'adminLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'user']);
Route::get('/admin', [DashboardController::class, 'admin']);
