<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::post("/login", [UserController::class, "login"]);
Route::post("/logout", [UserController::class, "logout"]);
Route::get("/tracker", function() {
    return "tracker page";
});

//Mail
Route::get('test', function() {
    \Illuminate\Support\Facades\Mail::to('lazar.stankovic.dev@gmail.com')->send(new \App\Mail\UserCreated());
});
