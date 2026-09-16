<?php

namespace App\Http\Controllers;

use App\Models\User; // 1. Added Model Import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Added Hash import for passwords

class user_loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 2. Removed the $ from User
        $users = User::all(); 
        return $users;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 3. Changed 'require' to 'required'
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password'=> 'required|string|min:8',
            'role' => 'required|in:admin,staff',
        ]);

        // 4. Hash the password before saving to the database!
        $validated['password'] = Hash::make($validated['password']);

        $user_login = User::create($validated);
        
        return $user_login;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}