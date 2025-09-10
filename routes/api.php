<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("/login", [AuthController::class, "issueToken"]);
Route::get('/routines', [AuthController::class, "getRoutines"])->middleware(['auth:sanctum']);
Route::post('/routines', [AuthController::class, "createRoutine"])->middleware(['auth:sanctum']);
Route::patch("/routines/{id}", [AuthController::class, "updateRoutine"])->middleware(['auth:sanctum']);
Route::delete("/routines/{id}", [AuthController::class, "deleteRoutine"])->middleware(['auth:sanctum']);

Route::patch("/make-public", [AuthController::class, "makePublic"])->middleware('auth:sanctum');
