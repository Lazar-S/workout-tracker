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
Route::get("/register", [UserController::class, "register"]);
Route::post("/register", [UserController::class, "store"]);
