<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'ពេលព្រឹក', 'description' => 'Traditional Khmer dishes for the breakfast', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ពេលថ្ងៃ', 'description' => 'Traditional Khmer dishes for the lunch', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ពេលល្ងាច', 'description' => 'Traditional Khmer dishes for the dinner', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ភេសជ្ជៈ', 'description' => 'Beverages, hot and cold', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ផ្សេងៗ', 'description' => 'Sweet dishes and treats', 'created_at' => now(), 'updated_at' => now()],
           
        ]);
    }
}