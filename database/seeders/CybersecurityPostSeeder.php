<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CybersecurityPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cyberSecurityCategory = Category::where('category_name', 'Cybersecurity')->first();
        $author = User::all();

        $posts = [
            [
                'title' => 'Top Cybersecurity Threats in 2024',
                'slug' => 'top-cybersecurity-threats-in-2024',
                'excerpt' => 'What are the biggest cybersecurity threats this year?',
                'content' => 'From ransomware to phishing attacks, learn about the top cybersecurity threats in 2024 and how to protect yourself.',
                'image' => 'img/cyber-threats-2024.jpg',
                'views' => 150,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'How to Secure Your Home Network',
                'slug' => 'how-to-secure-your-home-network',
                'excerpt' => 'Tips for securing your home Wi-Fi and devices.',
                'content' => 'Your home network is vulnerable to attacks. Follow these steps to secure your Wi-Fi, router, and connected devices.',
                'image' => 'img/home-network-security.jpg',
                'views' => 120,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'Understanding Zero Trust Security',
                'slug' => 'understanding-zero-trust-security',
                'excerpt' => 'What is Zero Trust and why is it important?',
                'content' => 'Zero Trust is a security model that assumes no user or device is trusted by default. Learn how it works and why it’s critical for modern cybersecurity.',
                'image' => 'img/zero-trust-security.jpg',
                'views' => 180,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'How to Protect Against Phishing Attacks',
                'slug' => 'how-to-protect-against-phishing-attacks',
                'excerpt' => 'Tips for identifying and avoiding phishing scams.',
                'content' => 'Phishing attacks are on the rise. Learn how to recognize phishing attempts and protect your personal and business data.',
                'image' => 'img/phishing-attacks.jpg',
                'views' => 160,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'The Importance of Multi-Factor Authentication',
                'slug' => 'the-importance-of-multi-factor-authentication',
                'excerpt' => 'Why MFA is essential for cybersecurity.',
                'content' => 'Multi-factor authentication (MFA) adds an extra layer of security to your accounts. Discover why it’s a must-have for protecting sensitive data.',
                'image' => 'img/multi-factor-authentication.jpg',
                'views' => 150,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[1]->id,
            ],
            [
                'title' => 'How to Secure Your IoT Devices',
                'slug' => 'how-to-secure-your-iot-devices',
                'excerpt' => 'Tips for protecting your smart devices from cyber threats.',
                'content' => 'IoT devices are vulnerable to hacking. Learn how to secure your smart home devices and prevent unauthorized access.',
                'image' => 'img/iot-security.jpg',
                'views' => 140,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Rise of Ransomware Attacks',
                'slug' => 'the-rise-of-ransomware-attacks',
                'excerpt' => 'What is ransomware and how can you protect yourself?',
                'content' => 'Ransomware attacks are becoming more sophisticated. Learn how they work and what steps you can take to protect your data.',
                'image' => 'img/ransomware-attacks.jpg',
                'views' => 170,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'Best Practices for Password Security',
                'slug' => 'best-practices-for-password-security',
                'excerpt' => 'How to create and manage strong passwords.',
                'content' => 'Weak passwords are a major security risk. Follow these best practices to create strong, unique passwords and keep your accounts secure.',
                'image' => 'img/password-security.jpg',
                'views' => 130,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'The Role of AI in Cybersecurity',
                'slug' => 'the-role-of-ai-in-cybersecurity',
                'excerpt' => 'How AI is transforming the fight against cyber threats.',
                'content' => 'AI is being used to detect and respond to cyber threats in real-time. Learn how AI is enhancing cybersecurity defenses.',
                'image' => 'img/ai-cybersecurity.jpg',
                'views' => 190,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[2]->id,
            ],
            [
                'title' => 'How to Conduct a Security Audit',
                'slug' => 'how-to-conduct-a-security-audit',
                'excerpt' => 'A step-by-step guide to assessing your cybersecurity posture.',
                'content' => 'A security audit helps identify vulnerabilities in your systems. Learn how to conduct a thorough audit and improve your security.',
                'image' => 'img/security-audit.jpg',
                'views' => 120,
                'category_id' => $cyberSecurityCategory->id,
                'author' => $author[2]->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }
    }
}
