<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request, RateLimiter $limiter)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $throttleKey = Str::lower($request->input('email')) . '|' . $request->ip();

        if ($limiter->tooManyAttempts($throttleKey, 5)) {
            $seconds = $limiter->availableIn($throttleKey);
            return back()->withErrors([
                'email' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam ' . $seconds . ' detik.',
            ])->onlyInput('email');
        }

        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => 'aktif',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();
            $limiter->clear($throttleKey);

            return redirect()->intended('/superadmin');
        }

        $limiter->hit($throttleKey, 60);

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
