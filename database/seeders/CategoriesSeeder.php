<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Artificial Intelligence', 'category_slug' => Str::slug('Artificial Intelligence'), 'icon' => 'category-icons/robot.png'],
            ['category_name' => 'Cybersecurity', 'category_slug' => Str::slug('Cybersecurity'), 'icon' => 'category-icons/padlock.png'],
            ['category_name' => 'Software Development', 'category_slug' => Str::slug('Software Development'), 'icon' => 'category-icons/login.png'],
            ['category_name' => 'Cloud Computing', 'category_slug' => Str::slug('Cloud Computing'), 'icon' => 'category-icons/cloud-server.png'],
            ['category_name' => 'Tech Gadgets', 'category_slug' => Str::slug('Tech Gadgets'), 'icon' => 'category-icons/smartphone.png'],
            ['category_name' => 'Gaming & VR', 'category_slug' => Str::slug('Gaming & VR'), 'icon' => 'category-icons/console.png'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
