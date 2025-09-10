<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

Route::get("/", function () {
    return view('welcome');
});

Route::get("/login", function() {
    return view("auth.login");
});

//Forgot password & reset
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|max:30|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );

    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


//Auth
Route::get("/register", [UserController::class, "create"]);
Route::post("/register", [UserController::class, "store"]);
Route::post("/login", [UserController::class, "login"])->name('login');
Route::post("/logout", [UserController::class, "logout"]);
Route::get("/tracker", function() {
    return view("tracker", ["workouts" => Workout::where('user_id', Auth::user()->id->get()) ]);
})->middleware('auth');
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/tracker');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('/search', [UserController::class, 'search'])->middleware('auth:sanctum');


//API
//Route::post("/api/login", [AuthController::class, "login"]);

