<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id', 'name');

        $items = [
            ['category' => 'ពេលថ្ងៃ', 'name' => 'ស៊ុបគោ', 'description' => 'ស៊ុបគោរសជាតិឈ្ងុយឆ្ងាញ់', 'price' => 4.00, 'status' => 'available'],
            ['category' => 'ពេលថ្ងៃ', 'name' => 'ឆាខ្ទឹម', 'description' => 'ឆាខ្ទឹមសបំពងឈ្ងុយ', 'price' => 2.50, 'status' => 'available'],
            ['category' => 'ពេលថ្ងៃ', 'name' => 'ស្ងោរត្រឡាច', 'description' => 'ស្ងោរត្រឡាចជាមួយសាច់ជ្រូក', 'price' => 3.00, 'status' => 'available'],
            ['category' => 'ពេលថ្ងៃ', 'name' => 'ពងទាចៀនស្អំ', 'description' => 'ពងទាចៀនជាមួយស្អំ', 'price' => 2.00, 'status' => 'available'],
            ['category' => 'ពេលថ្ងៃ', 'name' => 'ស្ងោរជ្រក់', 'description' => 'ស្ងោរជ្រក់សាច់មាន់រសជាតិជូរអែម', 'price' => 3.50, 'status' => 'available'],
            ['category' => 'ពេលថ្ងៃ', 'name' => 'ម្ហូបត្រកួន', 'description' => 'ឆាត្រកួនប្រេងខ្យល់', 'price' => 2.00, 'status' => 'available'],
            ['category' => 'ពេលថ្ងៃ', 'name' => 'ឆាត្រកួន', 'description' => 'ឆាត្រកួនជាមួយសាច់ជ្រូក', 'price' => 2.50, 'status' => 'available'],
            ['category' => 'ពេលល្ងាច', 'name' => 'ទឹកសុទ្ធ', 'description' => 'ទឹកសុទ្ធត្រជាក់', 'price' => 0.50, 'status' => 'available'],
            ['category' => 'ពេលព្រឹក', 'name' => 'បាយសាច់ជ្រូក', 'description' => 'បាយសាច់ជ្រូកអាំងពេលព្រឹក', 'price' => 1.50, 'status' => 'available'],
            ['category' => 'ពេលព្រឹក', 'name' => 'បាយមាន់', 'description' => 'បាយមាន់ស្ទោរទឹកត្រីបុក', 'price' => 2.50, 'status' => 'available'],
            ['category' => 'ភេសជ្ជៈ', 'name' => 'បាយ', 'description' => 'បាយសមួយចាន', 'price' => 0.50, 'status' => 'available'],
            ['category' => 'ពេលល្ងាច', 'name' => 'គុយទាវ', 'description' => 'គុយទាវសាច់ជ្រូកទឹកស៊ុប', 'price' => 2.50, 'status' => 'available'],
            ['category' => 'ពេលល្ងាច', 'name' => 'បបរគ្រឿង', 'description' => 'បបរគ្រឿងសាច់ជ្រូកក្តៅៗ', 'price' => 2.00, 'status' => 'available'],

        ];

        foreach ($items as $item) {
            MenuItem::updateOrCreate(
                ['name' => $item['name']],
                [
                    'category_id' => $categoryIds[$item['category']],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'status' => $item['status'],
                ]
            );
        }
    }
}
