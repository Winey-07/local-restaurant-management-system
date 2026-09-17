<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $request)
    {
        $search = $request->input('search');
        

        //dynamic
        $sortBy = $request->input('sortBy');
        $sortDir = $request->input('sortDir');

        $limit = $request->query('limite', 10);

        $payments = Payment::with('order')
            ->when($search, function($query, $search){
                return $query->where('transaction_id', 'LIKE', "%{$search}%");
            })
            ->orderBy($sortBy, $sortDir)
            // ->get();
            ->paginate($limit);

        return response()->json($payments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json([
            'message' => 'Create a new payment'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:Cash,Credit Card,Mobile Payment',
            'payment_status' => 'required|in:Pending,Completed,Failed',
            'transaction_id' => 'nullable|string|max:255',
            'paid_at' => 'nullable|date',
        ]);
        $payment = Payment::create($validated);
        return response()->json([
            'message' => 'Payment created successfully',
            'payment' => $payment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with('order')->find($id);
        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found'

            ], 404);
        }
        return response()->json([
            'message' => 'Payment found',
            'payment' => $payment
        ]);
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
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:Cash,Credit Card,Mobile Payment',
            'payment_status' => 'required|in:Pending,Completed,Failed',
            'transaction_id' => 'nullable|string|max:255',
            'paid_at' => 'nullable|date',
        ]);
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found'
            ], 404);
        }
        $payment->update($validated);
        return response()->json([
            'message' => 'Payment updated successfully',
            'payment' => $payment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json([
                'message' => 'Payment not found'
            ], 404);
        }
        $payment->delete();
        return response()->json([
            'message' => 'Payment deleted successfully'
        ]);
    }
}
