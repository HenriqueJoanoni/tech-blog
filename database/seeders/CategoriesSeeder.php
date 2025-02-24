<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Artificial Intelligence'],
            ['category_name' => 'Cybersecurity'],
            ['category_name' => 'Software Development'],
            ['category_name' => 'Cloud Computing'],
            ['category_name' => 'Tech Gadgets'],
            ['category_name' => 'Gaming & VR'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
