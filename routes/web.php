<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view('welcome');
});

Route::get("/login", function() {
    return "yep";
});

//Auth
Route::get("/register", [UserController::class, "register"]);
Route::post("/register", [UserController::class, "store"]);
