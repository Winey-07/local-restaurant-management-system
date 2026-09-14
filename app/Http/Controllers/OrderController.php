<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Orders::with(['user', 'table', 'orderItems', 'payment'])->get();
        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource of order.
     */
    public function create()
    {
        return response()->json([
            'message' => 'Create a new order'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'table_id' => 'required|exists:restaurant_tables,id',
            'subtotal' => 'required|numeric',
            'total_discount' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|in:Pending,Preparing,Ready,Completed,Cancelled',
            'payment_status' => 'required|in:Unpaid,Paid',
        ]);

        $order = Orders::create($validated);


        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Orders::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $order->load(['user', 'table', 'orderItems', 'payment']);
        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Orders::find($id);
        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Orders::find($id);
        if (!$order) {
            return response()->json([
                'message' => 'Order not found',
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'table_id' => 'required|exists:restaurant_tables,id',
            'subtotal' => 'required|numeric',
            'total_discount' => 'required|numeric',
            'total_amount' => 'required|numeric',
            'status' => 'required|in:Pending,Preparing,Ready,Completed,Cancelled',
            'payment_status' => 'required|in:Unpaid,Paid',
        ]);

        $order->update($validated);

        return response()->json([
            'message' => 'Order updated successfully',
            'order' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Orders::find($id);
        if (!$order) {
            return response()->json([
                'message' => 'Order Not Found'
            ], 404);
        }

        $order->delete();
        return response()->json([
            'message' => 'Order deleted successfully'
        ]);
    }
}
