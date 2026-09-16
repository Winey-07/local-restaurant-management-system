<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return $category;

        $search = $request->input('search');

        $category = Category::with('memuItem')

        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $category = Category::create($validate);
        return $category;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ensure your relationship name matches your model (e.g., menuItems or Menu_items)
        $category = Category::with('menuItems')->findOrFail($id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate incoming request data first
            $validate = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);

            // Find the category or throw a 404, then update
            $category = Category::findOrFail($id);
            $category->update($validate);
            
            return $category;
        }
        catch (Exception $e) {
            return response()->json([
                'error' => 'Failed to update Category',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fixed typo: finfOrFail -> findOrFail
        $category = Category::findOrFail($id);
        $category->delete();
        
        return response()->json([
            'message' => 'Category is deleted'
        ], 200);
    }
}