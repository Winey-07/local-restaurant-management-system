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
        return response()->json($categories);    
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validate = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $category = Category::create($validate);
        return response()->json($category, 201);
        }
        catch (Exception $e){
            return response()->json([
                'error' => 'Failed to create category',
                'message' => $e->getMessage(),
            ], 500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       try{
         // Ensure your relationship name matches your model (e.g., menuItems or Menu_items)
        $category = Category::with('menuItems')->findOrFail($id);
        return $category;
       }
       //ModelNotFoundException is more specfic than expection 
       // if we insert Exception, it will return 500 not 404
       catch (ModelNotFoundException $e){
        return response()->json([
            'error' => 'Category not found',
        ],404);
       }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate incoming request data first
            $validate = $request->validate([
                             // categories=table, name=column, $id - mean that to ignore this ID if the name/column is already existed or have the same name
                'name' => 'required|string|max:255|categories,name,'. $id,

            ]);

            // Find the category or throw a 404, then update
            $category = Category::findOrFail($id);
            $category->update($validate);
            
            return response()->json($category);
        }
        catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Category not found',
            ], 404);
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
        try{
            $category = Category::findOrFail($id);
            $category->delete();
        
            return response()->json([
                'message' => 'Category deleted sucessfully'
            ], 200);
        }
        catch (ModelNotFoundException $e){
            return response()->json([
                'error' => 'Category not found',
            ], 404);
        }
        
    }
}