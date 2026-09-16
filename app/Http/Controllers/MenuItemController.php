<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;
use Exception;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Combine search and relationship loading into a single query chain
        $menuItems = MenuItem::with('Category')
            ->when($search, function($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->get();

        return response()->json($menuItems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id', // Note: ensure table name is plural if using standard migrations
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'price' => 'required|numeric',
            'image' => 'nullable',
            'status' => 'required|in:available,unavailable',
        ]);

        // Fixed: Use ::create instead of calling the class directly
        $menuItem = MenuItem::create($validated);

        return response()->json([
            'message' => 'MenuItem stored successfully',
            'menuItem' => $menuItem
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menuItem = MenuItem::with('OrderItem')->findOrFail($id);
        return response()->json($menuItem);
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
        try {
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
                'price' => 'required|numeric',
                'image' => 'nullable',
                'status' => 'required|in:available,unavailable',
            ]);

            // Fixed: Find the item first, then update it
            $menuItem = MenuItem::findOrFail($id);
            $menuItem->update($validated);

            return response()->json([
                'message' => 'MenuItem updated successfully',
                'menuItem' => $menuItem
            ], 200);

        } catch (Exception $e) {
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
        // Fixed: Correct syntax for finding and deleting
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();

        return response()->json([
            'message' => 'Menu is deleted'
        ], 200);
    }
}