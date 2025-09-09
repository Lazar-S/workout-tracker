<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    public function create(): View {
        return view("auth.register");
    }

    public function store(): RedirectResponse {
        $attributes = request()->validate([
            'first_name' => ['required', "min:2"],
            'last_name' => ['required', "min:2"],
            'username' => ['required', "max:20", Rule::unique('users')],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', Password::min(6)->max(30), 'confirmed'],
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        event(new Registered($user));

        return redirect()->route('verification.notice');
    }

    /**
     * @throws ValidationException
     */
    public function login(): RedirectResponse {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => "Credentials don't match",
            ]);
        }

        request()->session()->regenerate();

        return redirect('/tracker');
    }

    public function logout(): RedirectResponse {
        Auth::logout();

        return redirect('/login');
    }

    public function search(): string
    {
        $username = request()->username;
        $users = User::where('public', true)->where('username', $username)->get();
        return $users->toJson();
    }
}
