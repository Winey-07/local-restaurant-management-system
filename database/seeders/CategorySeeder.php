<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => '1', 'name' => 'ពេលព្រឹក', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '2', 'name' => 'ពេលថ្ងៃ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '3', 'name' => 'ពេលល្ងាច', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '4', 'name' => 'ភេសជ្ជៈ', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '5', 'name' => 'ផ្សេងៗ',  'created_at' => now(), 'updated_at' => now()],
           
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['id' => $category['id']],
                ['name' => $category['name']]
            );
        }
    }
}
