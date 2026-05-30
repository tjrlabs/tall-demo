<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::truncate();

        Post::create([
            'title' => 'The Future of Web Development: A Deep Dive into Modern Stacks',
            'body' => "Join us for an in-depth exploration of how modern web development has evolved over the past decade. We'll cover the rise of component-based architectures, reactive UIs, and how frameworks like Laravel and Livewire are changing the way developers build full-stack applications without leaving the comfort of PHP.\n\nThis session is perfect for developers at any level — whether you're curious about TALL stack, reactive components, or just want to see what's possible with today's tooling. Our speakers will walk through real-world examples, live coding demos, and Q&A.\n\nLight refreshments will be provided. Don't miss your chance to connect with fellow developers and level up your skills.",
            'event_at' => now()->addHours(2),
        ]);
    }
}
