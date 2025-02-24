<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GamingVRPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gamingVRCategory = Category::where('category_name', 'Gaming & VR')->first();
        $author = User::all();

        $posts = [
            [
                'title' => 'The Future of Virtual Reality',
                'slug' => 'the-future-of-virtual-reality',
                'excerpt' => 'What’s next for VR technology?',
                'content' => 'Virtual reality is evolving rapidly, with new applications in gaming, education, and healthcare. Explore the future of VR.',
                'image' => 'img/future-of-vr.jpg',
                'views' => 170,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Top VR Games in 2024',
                'slug' => 'top-vr-games-in-2024',
                'excerpt' => 'Discover the best VR games to play this year.',
                'content' => 'From action-packed adventures to immersive simulations, here are the top VR games in 2024.',
                'image' => 'img/top-vr-games.jpg',
                'views' => 190,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Evolution of Virtual Reality Gaming',
                'slug' => 'the-evolution-of-virtual-reality-gaming',
                'excerpt' => 'How VR gaming has evolved over the years.',
                'content' => 'From early prototypes to modern headsets, VR gaming has come a long way. Explore the history and future of VR gaming.',
                'image' => 'img/vr-gaming-evolution.jpg',
                'views' => 200,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Best VR Headsets for 2024',
                'slug' => 'best-vr-headsets-for-2024',
                'excerpt' => 'Which VR headsets are worth buying this year?',
                'content' => 'From the Meta Quest 3 to the PlayStation VR2, here are the best VR headsets available in 2024.',
                'image' => 'img/best-vr-headsets-2024.jpg',
                'views' => 180,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'How VR is Changing the Gaming Industry',
                'slug' => 'how-vr-is-changing-the-gaming-industry',
                'excerpt' => 'The impact of VR on game design and player experiences.',
                'content' => 'VR is transforming how games are designed and played. Learn how VR is pushing the boundaries of immersion and interactivity.',
                'image' => 'img/vr-gaming-industry.jpg',
                'views' => 170,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Top VR Games for Fitness',
                'slug' => 'top-vr-games-for-fitness',
                'excerpt' => 'Stay active with these fun VR fitness games.',
                'content' => 'VR isn’t just for gaming—it’s also a great way to stay fit. Check out the best VR games for exercise and fitness.',
                'image' => 'img/vr-fitness-games.jpg',
                'views' => 160,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Future of Augmented Reality Gaming',
                'slug' => 'the-future-of-augmented-reality-gaming',
                'excerpt' => 'What’s next for AR gaming?',
                'content' => 'Augmented reality (AR) is blending the real and virtual worlds. Explore the future of AR gaming and its potential applications.',
                'image' => 'img/ar-gaming-future.jpg',
                'views' => 150,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'How to Set Up Your VR Gaming Space',
                'slug' => 'how-to-set-up-your-vr-gaming-space',
                'excerpt' => 'Tips for creating the perfect VR gaming environment.',
                'content' => 'A well-designed VR gaming space enhances your experience. Learn how to set up your space for maximum comfort and immersion.',
                'image' => 'img/vr-gaming-space.jpg',
                'views' => 140,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Best VR Games for Horror Fans',
                'slug' => 'the-best-vr-games-for-horror-fans',
                'excerpt' => 'Get ready for spine-chilling VR horror experiences.',
                'content' => 'VR horror games take fear to the next level. Check out the best VR horror games for a truly terrifying experience.',
                'image' => 'img/vr-horror-games.jpg',
                'views' => 130,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Role of VR in Esports',
                'slug' => 'the-role-of-vr-in-esports',
                'excerpt' => 'How VR is shaping the future of competitive gaming.',
                'content' => 'VR is making its way into esports, offering new ways to compete and spectate. Learn how VR is changing the esports landscape.',
                'image' => 'img/vr-esports.jpg',
                'views' => 120,
                'category_id' => $gamingVRCategory->id,
                'author' => $author[1]->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
