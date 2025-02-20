<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $technologyCategory = Category::where('category_name', 'Technology')->first();
        $programmingCategory = Category::where('category_name', 'Programming')->first();

        $posts = [
            [
                'title' => 'The Future of AI in 2025',
                'slug' => Str::slug('The Future of AI in 2025'),
                'excerpt' => 'AI is evolving rapidly. What’s next?',
                'content' => 'AI is changing the world... (full content here)',
                'image' => 'img/ai-technology-2025.jpg',
                'views' => 10,
                'category_id' => $technologyCategory->id,
                'author' => 'Henrique',
            ],
            [
                'title' => 'Top 10 Web Development Trends',
                'slug' => Str::slug('Top 10 Web Development Trends'),
                'excerpt' => 'Stay ahead in web development with these trends.',
                'content' => 'Web technologies are growing... (full content here)',
                'image' => 'img/web-development-trend.jpg',
                'views' => 5,
                'category_id' => $technologyCategory->id,
                'author' => 'Henrique',
            ],
            [
                'title' => 'How to Secure Your Website from Hackers',
                'slug' => Str::slug('How to Secure Your Website from Hackers'),
                'excerpt' => 'Security is crucial. Here’s how you can stay safe.',
                'content' => 'With increasing cyber threats... (full content here)',
                'image' => 'img/hackers.jpg',
                'views' => 2,
                'category_id' => $programmingCategory->id,
                'author' => 'Henrique',
            ],
            [
                'title' => 'Exploring the Metaverse',
                'slug' => Str::slug('Exploring the Metaverse'),
                'excerpt' => 'A new digital world is emerging. Are you ready?',
                'content' => 'The metaverse offers endless possibilities... (full content here)',
                'image' => 'img/metaverse-exploration.jpg',
                'views' => 8,
                'category_id' => $technologyCategory->id,
                'author' => 'Henrique',
            ],
            [
                'title' => 'The Rise of Quantum Computing',
                'slug' => Str::slug('The Rise of Quantum Computing'),
                'excerpt' => 'Quantum computing is reshaping technology.',
                'content' => 'Quantum computers can solve complex problems... (full content here)',
                'image' => 'img/quantum-computing.jpg',
                'views' => 6,
                'category_id' => $technologyCategory->id,
                'author' => 'Henrique',
            ],
            [
                'title' => 'Best Programming Languages to Learn in 2025',
                'slug' => Str::slug('Best Programming Languages to Learn in 2025'),
                'excerpt' => 'Which programming languages should you learn next?',
                'content' => 'Python, JavaScript, and Rust are trending... (full content here)',
                'image' => 'img/programming-languages.jpg',
                'views' => 9,
                'category_id' => $technologyCategory->id,
                'author' => 'Henrique',
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
