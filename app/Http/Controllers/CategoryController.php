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
        $category = Category::with('Menu_items')->findOrFail($id);
        return $category;
    }

  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $category = Category::findOrFound($id);

            $validate = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                
            ]);

            $category = Category::findOrFail($id);
            $category ->update($validate);
            return $category;
        }
        catch (Exception $e){
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
        $category = Category::finfOrFail($id)->delete();
        return "Category is deleted";
    }
}