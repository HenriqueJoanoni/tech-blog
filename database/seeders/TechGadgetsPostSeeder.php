<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class TechGadgetsPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $techGadgets = Category::where('category_name', 'Tech Gadgets')->first();
        $author = User::all();

        $posts = [
            [
                'title' => 'Best Smartphones of 2024',
                'slug' => 'best-smartphones-of-2024',
                'excerpt' => 'Which smartphones are worth buying this year?',
                'content' => 'From the latest iPhone to Android flagships, here are the best smartphones of 2024.',
                'image' => 'post-cover/mobile-phone-1875813_1280.jpg',
                'views' => 250,
                'category_id' => $techGadgets->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Top Wearable Tech in 2024',
                'slug' => 'top-wearable-tech-in-2024',
                'excerpt' => 'Discover the best wearable gadgets this year.',
                'content' => 'From smartwatches to fitness trackers, here are the top wearable tech devices in 2024.',
                'image' => 'post-cover/istockphoto-1170073824-1024x1024.jpg',
                'views' => 160,
                'category_id' => $techGadgets->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Best Smartwatches of 2024',
                'slug' => 'the-best-smartwatches-of-2024',
                'excerpt' => 'Which smartwatches are worth buying this year?',
                'content' => 'From fitness tracking to advanced health monitoring, here are the best smartwatches available in 2024.',
                'image' => 'post-cover/smartwatch-8300238_1280.jpg',
                'views' => 250,
                'category_id' => $techGadgets->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Top Wireless Earbuds for 2024',
                'slug' => 'top-wireless-earbuds-for-2024',
                'excerpt' => 'Discover the best wireless earbuds this year.',
                'content' => 'Wireless earbuds are more popular than ever. Check out the top models for sound quality, comfort, and battery life in 2024.',
                'image' => 'post-cover/earphones-5598952_1280.jpg',
                'views' => 230,
                'category_id' => $techGadgets->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Rise of Foldable Smartphones',
                'slug' => 'the-rise-of-foldable-smartphones',
                'excerpt' => 'Are foldable smartphones the future?',
                'content' => 'Foldable smartphones are pushing the boundaries of design and functionality. Learn about the latest models and their pros and cons.',
                'image' => 'post-cover/2022-08-30-image-12.jpg',
                'views' => 220,
                'category_id' => $techGadgets->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Best Laptops for Developers in 2024',
                'slug' => 'best-laptops-for-developers-in-2024',
                'excerpt' => 'Which laptops are ideal for coding and development?',
                'content' => 'Developers need powerful and reliable laptops. Here are the best options for coding, testing, and running heavy workloads in 2024.',
                'image' => 'post-cover/laptop-5673901_1280.jpg',
                'views' => 210,
                'category_id' => $techGadgets->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Top Home Automation Gadgets for 2024',
                'slug' => 'top-home-automation-gadgets-for-2024',
                'excerpt' => 'Transform your home with these smart gadgets.',
                'content' => 'From smart lights to voice-controlled assistants, here are the best home automation gadgets to make your life easier in 2024.',
                'image' => 'post-cover/smart-home-4905026_1280.jpg',
                'views' => 200,
                'category_id' => $techGadgets->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Best Drones for Beginners in 2024',
                'slug' => 'the-best-drones-for-beginners-in-2024',
                'excerpt' => 'Which drones are perfect for beginners?',
                'content' => 'Drones are fun and versatile gadgets. Here are the best drones for beginners, offering ease of use and great features.',
                'image' => 'post-cover/drone-1866961_1280.jpg',
                'views' => 190,
                'category_id' => $techGadgets->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Top Gaming Accessories for 2024',
                'slug' => 'top-gaming-accessories-for-2024',
                'excerpt' => 'Enhance your gaming setup with these accessories.',
                'content' => 'From mechanical keyboards to high-performance mice, here are the best gaming accessories to level up your experience in 2024.',
                'image' => 'post-cover/istockphoto-1170073824-1024x1024.jpg',
                'views' => 180,
                'category_id' => $techGadgets->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Future of Wearable Technology',
                'slug' => 'the-future-of-wearable-technology',
                'excerpt' => 'What’s next for wearables?',
                'content' => 'Wearable technology is evolving rapidly. Explore the latest trends and innovations in smartwatches, fitness trackers, and more.',
                'image' => 'post-cover/future-2372183_1280.jpg',
                'views' => 170,
                'category_id' => $techGadgets->id,
                'author' => $author[1]->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
