<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DistributorsController;
use App\Http\Controllers\Offer_NegotiationsController;
use App\Http\Controllers\Offer_petanisController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.register',[
        'title' => 'Register'
    ]);
})->name('register');

Route::resource('distributors',DistributorsController::class);
Route::post('loginpost',[AuthController::class,'loginprocess'])->name('login.post');
Route::get('login',[AuthController::class,'login'])->name('login');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('registerpost/{formcode}',[AuthController::class,'registrationprocess'])->name('register.post');

Route::resource('roles',RoleController::class);
Route::resource('permissions',PermissionController::class);
Route::resource('offerpetanis',Offer_petanisController::class);

Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
Route::resource('users',UserController::class);

Route::get('edit-penawaran',[Offer_NegotiationsController::class,'']);