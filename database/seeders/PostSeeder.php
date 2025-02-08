<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'The Future of AI in 2025',
                'slug' => Str::slug('The Future of AI in 2025'),
                'excerpt' => 'AI is evolving rapidly. What’s next?',
                'content' => 'AI is changing the world... (full content here)',
                'image' => 'https://source.unsplash.com/600x400/?technology,ai',
                'views' => 10,
                'category' => 'Technology',
            ],
            [
                'title' => 'Top 10 Web Development Trends',
                'slug' => Str::slug('Top 10 Web Development Trends'),
                'excerpt' => 'Stay ahead in web development with these trends.',
                'content' => 'Web technologies are growing... (full content here)',
                'image' => 'https://source.unsplash.com/600x400/?technology,code',
                'views' => 5,
                'category' => 'Technology',
            ],
            [
                'title' => 'How to Secure Your Website from Hackers',
                'slug' => Str::slug('How to Secure Your Website from Hackers'),
                'excerpt' => 'Security is crucial. Here’s how you can stay safe.',
                'content' => 'With increasing cyber threats... (full content here)',
                'image' => 'https://source.unsplash.com/600x400/?security,hacker',
                'views' => 2,
                'category' => 'Programming',
            ],
            [
                'title' => 'Exploring the Metaverse',
                'slug' => Str::slug('Exploring the Metaverse'),
                'excerpt' => 'A new digital world is emerging. Are you ready?',
                'content' => 'The metaverse offers endless possibilities... (full content here)',
                'image' => 'https://source.unsplash.com/600x400/?vr,metaverse',
                'views' => 8,
                'category' => 'Technology',
            ],
            [
                'title' => 'The Rise of Quantum Computing',
                'slug' => Str::slug('The Rise of Quantum Computing'),
                'excerpt' => 'Quantum computing is reshaping technology.',
                'content' => 'Quantum computers can solve complex problems... (full content here)',
                'image' => 'https://source.unsplash.com/600x400/?quantum,computing',
                'views' => 6,
                'category' => 'Technology',
            ],
            [
                'title' => 'Best Programming Languages to Learn in 2025',
                'slug' => Str::slug('Best Programming Languages to Learn in 2025'),
                'excerpt' => 'Which programming languages should you learn next?',
                'content' => 'Python, JavaScript, and Rust are trending... (full content here)',
                'image' => 'https://source.unsplash.com/600x400/?programming,code',
                'views' => 9,
                'category' => 'Technology',
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
