<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class UserController extends Controller
{
    public function register(): View {
        return view("auth.register");
    }

    public function store(): Void {
        dd(request()->all());
        $attributes = request()->validate([
            'first_name' => ['required', "min:2"],
            'last_name' => ['required', "min:2"],
            'username' => ['required', "max:20"],
            'email' => ['required', 'email', 'max:254'],
            'password' => ['required', Password::min(6)->max(30)->letters()->numbers()->mixedCase(), 'confirmed'],
        ]);

        dd($attributes);

        $user = User::create($attributes);

        Auth::login($user);

    }
}
