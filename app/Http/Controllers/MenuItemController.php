<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use Exception;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Resquest $request)
    {
        // add search in MenuItems
        $search = $request->input('search');

        $menuItems = MenuItem::when($search, function($query, $search){
            return $query->where('name', 'LIKE', "%{$search}%");
        })->get();
        return $menuItems;

        $menuItems = MenuItem::with('categories')->get();
        return response()->json($menuItems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        return response()->json;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric',
            'image' => 'nullable',
            'status' => 'required|in:available,unavailable',

        ]);
        $menuItem = MenuItem($validated);

        return response()->json([
            'message' => 'MenuItem store successfully',
            'menuItem' => $menuItem
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menuItems = MenuItem::with('order_items')->findOrFail($id);
        return $menuItems;
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
        try{
            $menuItems = MenuItem::findOrFound($id);

            $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric',
            'image' => 'nullable',
            'status' => 'required|in:available,unavailable',

        ]);
        $menuItem = MenuItem($validated);

        return response()->json([
            'message' => 'MenuItem update successfully',
            'menuItem' => $menuItem
        ],201);

        } catch (Exception $e){
            return response()->json([
                'error' => 'Failed to update Menu',
                'message' => $e->getMessage(),
            ], 500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menuItem -> MenuItem::findOrFail($id)->delete();
        return "Menu is deleted";
        
    
    }
}
