<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $menuItems = MenuItem::all()->keyBy('name');

        if ($orders->isEmpty() || $menuItems->isEmpty()) {
            $this->command->error('Orders or MenuItems missing. Please seed them first.');
            return;
        }

        // Map items based on order index
        $firstOrder = $orders->first();
        $secondOrder = $orders->skip(1)->first();
        $thirdOrder = $orders->skip(2)->first();

        $items = [];

        // Items for Order #1 ($10.00 total)
        if ($firstOrder) {
            $items[] = [
                'order_id' => $firstOrder->id,
                'menu_item_id' => $menuItems['ស៊ុបគោ']->id ?? 1,
                'quantity' => 2,
                'price' => $menuItems['ស៊ុបគោ']->price ?? 4.00, // 2 x 4.00 = 8.00
            ];
            $items[] = [
                'order_id' => $firstOrder->id,
                'menu_item_id' => $menuItems['ពងទាចៀនស្អំ']->id ?? 4,
                'quantity' => 1,
                'price' => $menuItems['ពងទាចៀនស្អំ']->price ?? 2.00, // 1 x 2.00 = 2.00
            ];
        }

        // Items for Order #2 ($20.00 total)
        if ($secondOrder) {
            $items[] = [
                'order_id' => $secondOrder->id,
                'menu_item_id' => $menuItems['ស្ងោរជ្រក់']->id ?? 5,
                'quantity' => 4,
                'price' => $menuItems['ស្ងោរជ្រក់']->price ?? 3.50, // 4 x 3.50 = 14.00
            ];
            $items[] = [
                'order_id' => $secondOrder->id,
                'menu_item_id' => $menuItems['ឆាត្រកួន']->id ?? 7,
                'quantity' => 2,
                'price' => $menuItems['ឆាត្រកួន']->price ?? 2.50, // 2 x 2.50 = 5.00
            ];
            $items[] = [
                'order_id' => $secondOrder->id,
                'menu_item_id' => $menuItems['បាយ']->id ?? 11,
                'quantity' => 2,
                'price' => $menuItems['បាយ']->price ?? 0.50, // 2 x 0.50 = 1.00
            ];
        }

        // Items for Order #3 ($15.00 total)
        if ($thirdOrder) {
            $items[] = [
                'order_id' => $thirdOrder->id,
                'menu_item_id' => $menuItems['គុយទាវ']->id ?? 12,
                'quantity' => 6,
                'price' => $menuItems['គុយទាវ']->price ?? 2.50, // 6 x 2.50 = 15.00
            ];
        }

        foreach ($items as $item) {
            OrderItem::create($item);
        }
    }
}