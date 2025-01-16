<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use Carbon\Carbon;

class AutoPublishPosts extends Command
{
    protected $signature = 'posts:auto-publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
 public function __construct()
    {
        parent::__construct();
    }

    public function handle()
{
        // Находим все посты, которые должны быть опубликованы (is_published = false и published_at <= now())
        $posts = Post::where('is_published', false)
                     ->where('published_at', '<=', now())
                     ->get();

        foreach ($posts as $post) {
            // Публикуем пост
            $post->update([
                'is_published' => true,
                'published_at' => now(),
            ]);

            $this->info("Пост '{$post->title}' был опубликован.");
        }
    }

}
