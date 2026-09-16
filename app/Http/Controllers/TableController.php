<?php

namespace App\Http\Controllers;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table = RestaurantTable::all();
        return $table;
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
        $validate = $request->validate([
            'table_number' => 'required|integer|max:255',
            'capacity'     => 'nullable|integer|max:255',
            'status'       => 'nullable|string|max:255',
        ]);

        $table = RestaurantTable::create($validate);
        return $table;
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
            'table_number' => 'required|integer|max:255',
            'capacity'     => 'nullable|integer|max:255',
            'status'       => 'nullable|string|max:255',
        ]);

        $table = RestaurantTable::findOrFail($id);
        $table -> update($validate);
        return $table;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $table = RestaurantTable::findOrFail($id)->delete();
    }
}
