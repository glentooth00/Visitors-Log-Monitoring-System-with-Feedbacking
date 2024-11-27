<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    

    public function loginHandler(Request $request)
    {
        // Validate the request
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ]);
    
        // Check if the username exists
        $user = Users::where('username', $request->username)->first();
    
        if (!$user) {
            // If the username doesn't exist, return an error for the username
            return back()->withErrors([
                'username' => 'Incorrect username.',
            ])->withInput($request->except('password'));
        }
    
        // If username exists, attempt to authenticate with the password
        if (!Auth::attempt($request->only('username', 'password'))) {
            // If password is incorrect, return an error for the password
            return back()->withErrors([
                'password' => 'Incorrect password.',
            ])->withInput($request->except('password'));
        }
    
        // If authentication is successful
        $request->session()->regenerate();
    
        // Redirect to admin.dashboard route
        return redirect()->route('admin.dashboard')->with('success', 'You are now logged in.');
    }
    
    public function logout()
    {
        Auth::logout();
        
        return view('login');
    }
    

}