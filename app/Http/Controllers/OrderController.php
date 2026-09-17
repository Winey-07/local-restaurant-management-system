<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        //dynamic: you can edit code and change the sortBy and sortDir values but you need to determinte the shortBy as name or id ...
        $sortBy = $request->input('sortBy'); // e.g., choose the  'name' or 'id' 
        $sortDir = $request->input('sortDir'); // e.g., sort direction from small to big or sort direction from big to small.

        // //Static: you can't edit or change the code because it determine already.
        // $sortBy = $request->query('sortBy', 'id'); // Default sort by 'id'
        // $sortDir = $request->query('sortDir', 'desc'); // descending order

        // Get limit for pagination (default to 10 if not provided)
        $limit = $request->query('limit', 10);

        // Combine search and relationship loading into a single query chain
        $orders = Order::with(['user', 'table', 'orderItems', 'payment'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'LIKE', "%{$search}%");
            })

            //add sort by and sort directiion
            ->orderBy($sortBy, $sortDir)


            //pagination: when you dertimine your page to show the limite of data which you want to show in your page. 
            //you can use limit to determine the number of data to show in your page. 

            
            // ->get(); //when you limit (pagination) you need to use paginate instead of get;
            ->paginate($limit); // Use paginate for pagination
            
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

        $order = Order::create($validated);


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
        $order = Order::find($id);
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
        $order = Order::find($id);
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
        $order = Order::find($id);
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
        $order = Order::find($id);
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
