<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RestaurantTable;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [
            ['table_number' => 1, 'capacity' => 2, 'status' => 'available'],
            ['table_number' => 2, 'capacity' => 2, 'status' => 'available'],
            ['table_number' => 3, 'capacity' => 4, 'status' => 'occupied'],
            ['table_number' => 4, 'capacity' => 4, 'status' => 'available'],
            ['table_number' => 5, 'capacity' => 4, 'status' => 'available'],
            ['table_number' => 6, 'capacity' => 6, 'status' => 'reserved'],
            ['table_number' => 7, 'capacity' => 6, 'status' => 'available'],
            ['table_number' => 8, 'capacity' => 2, 'status' => 'available'],
            ['table_number' => 9, 'capacity' => 4, 'status' => 'available'],
            ['table_number' => 10, 'capacity' => 8, 'status' => 'available'],
        ];

        foreach ($tables as $table) {
            RestaurantTable::updateOrCreate(
                ['table_number' => $table['table_number']],
                ['capacity' => $table['capacity'], 'status' => $table['status']]
            );
        }
    }
}
