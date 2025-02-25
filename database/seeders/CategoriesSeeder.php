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
            ['category_name' => 'Artificial Intelligence', 'category_slug' => Str::slug('Artificial Intelligence'), 'icon' => 'resources/img/robot.png'],
            ['category_name' => 'Cybersecurity', 'category_slug' => Str::slug('Cybersecurity'), 'icon' => 'resources/img/padlock.png'],
            ['category_name' => 'Software Development', 'category_slug' => Str::slug('Software Development'), 'icon' => 'resources/img/login.png'],
            ['category_name' => 'Cloud Computing', 'category_slug' => Str::slug('Cloud Computing'), 'icon' => 'resources/img/cloud-server.png'],
            ['category_name' => 'Tech Gadgets', 'category_slug' => Str::slug('Tech Gadgets'), 'icon' => 'resources/img/smartphone.png'],
            ['category_name' => 'Gaming & VR', 'category_slug' => Str::slug('Gaming & VR'), 'icon' => 'resources/img/console.png'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
