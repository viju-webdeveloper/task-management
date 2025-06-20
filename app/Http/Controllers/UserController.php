<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Logic to retrieve and return a list of users
        return view('auth.register');
    }

    /**
     * Handle the registration request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {

        // validating input 
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Registration successful!');
    }
}
