<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $search = $request->input('search');

        //dynamic
        $sortBy = $request->input('sortBy');
        $sortDir = $request->input('sortDir');

        // // static
        // $sortBy = $request->query('sortBy', 'id');
        // $sortDir = $request->query('sortDir', 'desc');

        $limit = $request->query('limit', 10);


        $orderItems = OrderItem::with('order','menuItem')
            ->when($search, function($query, $search){
                return $query->where('name', 'LIKE', "%{$search}%");
            })
            ->orderBy($sortBy, $sortDir)
            // ->get();
            ->paginate($limit);
        return response()->json($orderItems);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'message'=>'Create a new order item'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id'=>'required|exists:orders,id',
            'menu_item_id'=>'required|exists:menu_items,id',
            'quantity'=>'required|interger|min:1',
            'price'=>'required|numeric|min:0',
            'discount'=>'nullable|numeric|min:0',
            'subtotal'=>'required|numeric|min:0'
        ]);

        return response()->json([
            'message'=>'Order item created successfully',
            'orderItem'=> OrderItem::create($validated)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $orderItem = OrderItem::find($id);
        if(!$orderItem){
            return response()->json([
                'message'=>'Order item not found'
            ], 404);
        }
        $orderItem->load(['order', 'menuItem']);
        return response()->json($orderItem);
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
        $validated = $request->validate([
            'order_id'=>'required|exists:orders,id',
            'menu_item_id'=>'required|exists:menu_items,id',
            'quantity'=>'required|interger|min:1',
            'price'=>'required|numeric|min:0',
            'discount'=>'nullable|numeric|min:0',
            'subtotal'=>'required|numeric|min:0'
        ]);

        $orderItem = OrderItem::find($id);
        if(!$orderItem){
            return response()->json([
                'message'=>"Order item not found",
                'data'=>$orderItem
            ], 404);
        }
        $orderItem->update($validated);
        return response()->json([
            'message'=>'Order item updated successfully',
            'data'=>$orderItem
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderItem = OrderItem::find($id);
        if(!$orderItem){
            return response()->json([
                'message'=>'Order item not found'
            ], 404);
        }
        $orderItem->delete();
        return response()->json([
            'message'=>'Order item deleted successfully'
        ]);
        
    }
}
