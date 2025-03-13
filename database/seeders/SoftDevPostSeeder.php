<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoftDevPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devCategory = Category::where('category_name', 'Software Development')->first();
        $author = User::all();

        $posts = [
            [
                'title' => 'Top Programming Languages in 2024',
                'slug' => 'top-programming-languages-in-2024',
                'excerpt' => 'Which programming languages are trending this year?',
                'content' => 'Discover the most popular programming languages in 2024 and why they are in demand.',
                'image' => 'post-cover/pexels-harold-vasquez-853421-2653362.jpg',
                'views' => 200,
                'category_id' => $devCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Best Practices for Clean Code',
                'slug' => 'best-practices-for-clean-code',
                'excerpt' => 'Write clean, maintainable code with these tips.',
                'content' => 'Clean code is essential for collaboration and long-term maintenance. Learn the best practices for writing clean code.',
                'image' => 'post-cover/pexels-luis-gomes-166706-546819.jpg',
                'views' => 180,
                'category_id' => $devCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Introduction to Agile Development',
                'slug' => 'introduction-to-agile-development',
                'excerpt' => 'What is Agile and why is it popular?',
                'content' => 'Agile development focuses on iterative progress, collaboration, and flexibility. Learn the core principles of Agile and how it benefits software teams.',
                'image' => 'post-cover/pexels-thisisengineering-3861952.jpg',
                'views' => 220,
                'category_id' => $devCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Rise of Low-Code and No-Code Platforms',
                'slug' => 'the-rise-of-low-code-and-no-code-platforms',
                'excerpt' => 'How low-code and no-code are changing software development.',
                'content' => 'Low-code and no-code platforms are empowering non-developers to build applications. Discover their benefits and limitations.',
                'image' => 'post-cover/pexels-danny-meneses-340146-943096.jpg',
                'views' => 190,
                'category_id' => $devCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Best Practices for Code Reviews',
                'slug' => 'best-practices-for-code-reviews',
                'excerpt' => 'How to conduct effective code reviews.',
                'content' => 'Code reviews are essential for maintaining code quality. Learn best practices for conducting constructive and efficient code reviews.',
                'image' => 'post-cover/pexels-thisisengineering-3912478.jpg',
                'views' => 180,
                'category_id' => $devCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Importance of DevOps in Modern Development',
                'slug' => 'the-importance-of-devops-in-modern-development',
                'excerpt' => 'Why DevOps is crucial for software teams.',
                'content' => 'DevOps bridges the gap between development and operations, enabling faster and more reliable software delivery. Learn why it’s essential.',
                'image' => 'post-cover/pexels-thisisengineering-3861958.jpg',
                'views' => 170,
                'category_id' => $devCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'How to Write Scalable Code',
                'slug' => 'how-to-write-scalable-code',
                'excerpt' => 'Tips for building scalable software systems.',
                'content' => 'Scalability is critical for modern applications. Discover strategies for writing code that can handle growth and increased demand.',
                'image' => 'post-cover/pexels-divinetechygirl-1181271.jpg',
                'views' => 160,
                'category_id' => $devCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Role of AI in Software Development',
                'slug' => 'the-role-of-ai-in-software-development',
                'excerpt' => 'How AI is transforming the development process.',
                'content' => 'AI is being used for code generation, bug detection, and more. Explore how AI is revolutionizing software development.',
                'image' => 'post-cover/pexels-cottonbro-6153354.jpg',
                'views' => 150,
                'category_id' => $devCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Understanding Microservices Architecture',
                'slug' => 'understanding-microservices-architecture',
                'excerpt' => 'What are microservices and why are they popular?',
                'content' => 'Microservices break applications into smaller, independent components. Learn the benefits and challenges of this architecture.',
                'image' => 'post-cover/pexels-divinetechygirl-1181298.jpg',
                'views' => 140,
                'category_id' => $devCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Top Tools for Software Developers in 2024',
                'slug' => 'top-tools-for-software-developers-in-2024',
                'excerpt' => 'Essential tools for modern developers.',
                'content' => 'From IDEs to version control systems, here are the top tools every software developer should know about in 2024.',
                'image' => 'post-cover/pexels-divinetechygirl-1181263.jpg',
                'views' => 210,
                'category_id' => $devCategory->id,
                'author' => $author[2]->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
