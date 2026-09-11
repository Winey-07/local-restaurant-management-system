<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return $category;
    }

    /**
     

    
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'Cambodia_Food' => 'required|string|max:255',
            'Rice'          => 'nullable|string|max:255',
            'Noodle'        => 'nullable|string|max:255',
            'Drink'         => 'nullable|string|max:255'
        ]);

        $category = Category::create($validate);
        return $category;
        
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
        $validate = $request->validate([
            'Cambodia_Food' => 'nullable|string|max:255',
            'Rice'          => 'nullable|string|max:255',
            'Noodle'        => 'nullable|string|max:255',
            'Drink'         => 'nullable|string|max:255',
            'Desserts'      => 'nullable|string|max:255'
        ]);

        $category = Category::findOrFail($id);
        $category ->update($validate);
        return $category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::finfOrFail($id)->delete();
    }
}
