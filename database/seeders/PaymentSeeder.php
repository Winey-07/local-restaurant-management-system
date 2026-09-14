<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();

        if ($orders->isEmpty()) {
            $this->command->error('No orders found. Please seed orders first.');
            return;
        }

        $secondOrder = $orders->skip(1)->first();
        $thirdOrder = $orders->skip(2)->first();

        $payments = [];

        // Paid Order (#2 - $20.00)
        if ($secondOrder) {
            $payments[] = [
                'order_id' => $secondOrder->id,
                'payment_method' => 'KHQR',
                'amount' => $secondOrder->total_amount,
                'status' => 'Completed',
                'transaction_id' => 'TXN-KHQR-' . strtoupper(uniqid()),
                'paid_at' => now(),
            ];
        }

        // Refunded Order (#3 - $15.00)
        if ($thirdOrder) {
            $payments[] = [
                'order_id' => $thirdOrder->id,
                'payment_method' => 'Cash',
                'amount' => $thirdOrder->total_amount,
                'status' => 'Refunded',
                'transaction_id' => 'TXN-CASH-' . strtoupper(uniqid()),
                'paid_at' => now()->subHours(2),
            ];
        }

        foreach ($payments as $payment) {
            Payment::updateOrCreate(
                ['order_id' => $payment['order_id']],
                $payment
            );
        }
    }
}