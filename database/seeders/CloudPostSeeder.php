<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CloudPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cloudCategory = Category::where('category_name', 'Cloud Computing')->first();
        $author = User::all();

        $posts = [
            [
                'title' => 'Introduction to Cloud Computing',
                'slug' => 'introduction-to-cloud-computing',
                'excerpt' => 'What is cloud computing and why is it important?',
                'content' => 'Cloud computing is revolutionizing how businesses store and process data. Learn the basics of cloud computing and its benefits.',
                'image' => 'post-cover/cloud-computing-1989339_1280.png',
                'views' => 130,
                'category_id' => $cloudCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Top Cloud Providers in 2024',
                'slug' => 'top-cloud-providers-in-2024',
                'excerpt' => 'Which cloud providers are leading the market?',
                'content' => 'AWS, Azure, and Google Cloud are the top cloud providers in 2024. Compare their features and pricing.',
                'image' => 'post-cover/pexels-cookiecutter-1148820.jpg',
                'views' => 140,
                'category_id' => $cloudCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Understanding Serverless Computing',
                'slug' => 'understanding-serverless-computing',
                'excerpt' => 'What is serverless computing and how does it work?',
                'content' => 'Serverless computing allows developers to build and run applications without managing servers. Learn how it works and its benefits.',
                'image' => 'post-cover/cloud-3843352_1280.jpg',
                'views' => 110,
                'category_id' => $cloudCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Benefits of Multi-Cloud Strategies',
                'slug' => 'benefits-of-multi-cloud-strategies',
                'excerpt' => 'Why are businesses adopting multi-cloud strategies?',
                'content' => 'Multi-cloud strategies offer flexibility, redundancy, and cost optimization. Discover why businesses are leveraging multiple cloud providers.',
                'image' => 'post-cover/startup-7374154_1280.jpg',
                'views' => 95,
                'category_id' => $cloudCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'How to Migrate to the Cloud',
                'slug' => 'how-to-migrate-to-the-cloud',
                'excerpt' => 'A step-by-step guide to cloud migration.',
                'content' => 'Migrating to the cloud can be complex. This guide walks you through the process, from planning to execution.',
                'image' => 'post-cover/cloud-computing-4246668_1280.jpg',
                'views' => 130,
                'category_id' => $cloudCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Cloud Security Best Practices',
                'slug' => 'cloud-security-best-practices',
                'excerpt' => 'How to secure your cloud infrastructure.',
                'content' => 'Cloud security is critical for protecting data and applications. Learn the best practices for securing your cloud environment.',
                'image' => 'post-cover/cyber-security-8819383_1280.jpg',
                'views' => 140,
                'category_id' => $cloudCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Cost Optimization in Cloud Computing',
                'slug' => 'cost-optimization-in-cloud-computing',
                'excerpt' => 'How to reduce cloud costs without sacrificing performance.',
                'content' => 'Cloud costs can spiral out of control. Discover strategies for optimizing costs while maintaining performance and scalability.',
                'image' => 'post-cover/financial-4560047_1280.jpg',
                'views' => 120,
                'category_id' => $cloudCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Role of Kubernetes in Cloud Computing',
                'slug' => 'the-role-of-kubernetes-in-cloud-computing',
                'excerpt' => 'How Kubernetes is transforming cloud infrastructure.',
                'content' => 'Kubernetes is a powerful tool for managing containerized applications in the cloud. Learn how it works and why it’s essential.',
                'image' => 'post-cover/65535c0459f914d06ddeef7a_Kubernetes-Everything-You-Need-to-Know-2048x1159.jpg',
                'views' => 100,
                'category_id' => $cloudCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Edge Computing vs Cloud Computing',
                'slug' => 'edge-computing-vs-cloud-computing',
                'excerpt' => 'What’s the difference between edge and cloud computing?',
                'content' => 'Edge computing and cloud computing serve different purposes. Explore their differences and use cases.',
                'image' => 'post-cover/cloud-computing-2001090_1280.jpg',
                'views' => 90,
                'category_id' => $cloudCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Future of Cloud Computing',
                'slug' => 'the-future-of-cloud-computing',
                'excerpt' => 'What’s next for cloud technology?',
                'content' => 'Cloud computing is constantly evolving. From AI integration to quantum computing, explore the future of cloud technology.',
                'image' => 'post-cover/cloud-computing-2001090_1280.jpg',
                'views' => 150,
                'category_id' => $cloudCategory->id,
                'author' => $author[2]->id,
            ]
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
