<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display the login form.
     *
     * @return \Illuminate\View\View
     */
    //

    public function index()
    {
        // Logic to handle session creation, such as showing the login form
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        // Logic to handle user login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return redirect('/');
        }

        // Authentication failed, redirect back with an error message
        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    /**
     * Handle the logout request.
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy()
    {
        // Logic to handle user logout
        Auth::logout();
        return redirect('/login')->with('success', 'Logged out successfully!');
    }
}
