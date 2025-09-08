<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get("/", function () {
    return view('welcome');
});

Route::get("/login", function() {
    return view("auth.login");
});

Route::get("/forgot-password", function() {
    return view("auth.forgot-password");
});

//Auth
Route::get("/register", [UserController::class, "create"]);
Route::post("/register", [UserController::class, "store"]);
Route::post("/login", [UserController::class, "login"])->name('login');
Route::post("/logout", [UserController::class, "logout"]);
Route::get("/tracker", function() {
    return view("tracker");
});
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

//Mail
Route::get('test', function() {


});
