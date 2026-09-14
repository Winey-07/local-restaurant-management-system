<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->error('No users found in the database. Please seed users first.');
            return;
        }

        $orders = [
            [
                'user_id'        => $user->id,
                'table_id'       => 1,
                'status'         => 'Pending',
                'total_amount'   => 10.00,
                'payment_status' => 'Pending',
            ],
            [
                'user_id'        => $user->id,
                'table_id'       => 2,
                'status'         => 'Completed',
                'total_amount'   => 20.00,
                'payment_status' => 'Paid',
            ],
            [
                'user_id'        => $user->id,
                'table_id'       => 3,
                'status'         => 'Cancelled',
                'total_amount'   => 15.00,
                'payment_status' => 'Refunded',
            ],
        ];

        foreach ($orders as $orderData) {
            Order::create($orderData);
        }
    }
}