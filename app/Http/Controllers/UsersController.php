<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     */
    public function index()
    {
        $users = Users::all(); // Fetch all users
        return view('admin.password.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Users  $users
     * 
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users  $users
     * 
     */
    public function edit(Users $users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users  $users
     * 
     */
    public function update(Request $request, Users $user)
    {
        // Validate the input
        $validated = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Update the password (hashed)
        $user->password = Hash::make($validated['password']);
        $user->save();

        // Redirect back with a success message
        return redirect()->back() // Adjust the route if needed
            ->with('success', 'Password updated successfully!');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users  $users
     * 
     */
    public function destroy(Users $users)
    {
        //
    }
}
