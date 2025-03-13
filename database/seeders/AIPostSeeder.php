<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Post;

class AIPostSeeder extends Seeder
{
    public function run(): void
    {
        $aiCategory = Category::where('category_name', 'Artificial Intelligence')->first();
        $author = User::all();

        $posts = [
            [
                'title' => 'The Future of AI in 2025',
                'slug' => 'the-future-of-ai-in-2025',
                'excerpt' => 'AI is evolving rapidly. What’s next?',
                'content' => 'AI is changing the world with advancements in machine learning, natural language processing, and robotics. By 2025, we can expect AI to revolutionize industries like healthcare, finance, and transportation.',
                'image' => 'post-cover/ai-technology-2025.jpg',
                'views' => 120,
                'category_id' => $aiCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'How AI is Transforming Healthcare',
                'slug' => 'how-ai-is-transforming-healthcare',
                'excerpt' => 'AI is revolutionizing healthcare with predictive analytics and personalized medicine.',
                'content' => 'From diagnosing diseases to predicting patient outcomes, AI is making healthcare more efficient and accurate. Learn how AI is transforming the medical field.',
                'image' => 'post-cover/pexels-shvetsa-3845129.jpg',
                'views' => 95,
                'category_id' => $aiCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Ethical Concerns in AI Development',
                'slug' => 'ethical-concerns-in-ai-development',
                'excerpt' => 'As AI grows, so do ethical concerns. What are the risks?',
                'content' => 'AI development raises ethical questions about bias, privacy, and job displacement. This post explores the challenges and potential solutions.',
                'image' => 'post-cover/pexels-mati-5952651.jpg',
                'views' => 80,
                'category_id' => $aiCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Top AI Tools for Developers in 2024',
                'slug' => 'top-ai-tools-for-developers-in-2024',
                'excerpt' => 'Discover the best AI tools for developers this year.',
                'content' => 'From TensorFlow to PyTorch, here are the top AI tools that every developer should know about in 2024.',
                'image' => 'post-cover/pexels-markus-winkler-1430818-30855412.jpg',
                'views' => 110,
                'category_id' => $aiCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'AI in Autonomous Vehicles',
                'slug' => 'ai-in-autonomous-vehicles',
                'excerpt' => 'How AI is powering self-driving cars.',
                'content' => 'Autonomous vehicles rely on AI for navigation, object detection, and decision-making. Learn how AI is shaping the future of transportation.',
                'image' => 'post-cover/pexels-shkrabaanthony-30840781.jpg',
                'views' => 75,
                'category_id' => $aiCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Role of AI in Climate Change',
                'slug' => 'the-role-of-ai-in-climate-change',
                'excerpt' => 'Can AI help combat climate change?',
                'content' => 'AI is being used to analyze climate data, optimize energy usage, and develop sustainable solutions. Explore how AI is contributing to the fight against climate change.',
                'image' => 'post-cover/pexels-pixabay-221012.jpg',
                'views' => 60,
                'category_id' => $aiCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'AI-Powered Chatbots: The Future of Customer Service',
                'slug' => 'ai-powered-chatbots-the-future-of-customer-service',
                'excerpt' => 'How AI chatbots are revolutionizing customer support.',
                'content' => 'AI chatbots are becoming smarter and more efficient, providing 24/7 customer service and reducing costs for businesses.',
                'image' => 'post-cover/pexels-bertellifotografia-16094061.jpg',
                'views' => 90,
                'category_id' => $aiCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'AI in Education: Personalized Learning',
                'slug' => 'ai-in-education-personalized-learning',
                'excerpt' => 'How AI is transforming education with personalized learning.',
                'content' => 'AI is enabling personalized learning experiences by adapting to individual student needs and providing real-time feedback.',
                'image' => 'post-cover/pexels-julia-m-cameron-4143800.jpg',
                'views' => 85,
                'category_id' => $aiCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Rise of Generative AI',
                'slug' => 'the-rise-of-generative-ai',
                'excerpt' => 'Generative AI is creating art, music, and more.',
                'content' => 'From generating realistic images to composing music, generative AI is pushing the boundaries of creativity.',
                'image' => 'post-cover/pexels-sanketgraphy-16380906.jpg',
                'views' => 100,
                'category_id' => $aiCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'AI in Finance: Predictive Analytics',
                'slug' => 'ai-in-finance-predictive-analytics',
                'excerpt' => 'How AI is transforming the finance industry.',
                'content' => 'AI is being used for fraud detection, risk assessment, and investment strategies. Learn how predictive analytics is changing finance.',
                'image' => 'post-cover/pexels-davidmcbee-730547.jpg',
                'views' => 70,
                'category_id' => $aiCategory->id,
                'author' => $author[2]->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
