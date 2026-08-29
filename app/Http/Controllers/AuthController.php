<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // Set default language
            $locale = Session::get('locale', 'en');
            App::setLocale($locale);

            return redirect()->intended('/dashboard')
                ->with('success', 'Welcome back, '.Auth::user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'The email or password you entered is incorrect.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show dashboard
     */
    public function dashboard()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        return view('dashboard');
    }
}
