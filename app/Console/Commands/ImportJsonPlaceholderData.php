<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Models\Comment;

class ImportJsonPlaceholderData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-json-placeholder-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get posts
        $posts = Http::get('https://jsonplaceholder.typicode.com/posts')->json();

        foreach ($posts as $postData) {
            $post = Post::updateOrCreate(
                ['external_id' => $postData['id']],
                [
                    'title' => $postData['title'],
                    'body' => $postData['body'],
                ]
            );

            // Get comments for each post
            $comments = Http::get("https://jsonplaceholder.typicode.com/comments?postId={$postData['id']}")->json();

            foreach ($comments as $commentData) {
                $post->comments()->create([
                    'body' => $commentData['body'],
                    'email' => $commentData['email'],
                ]);
            }
        }

        $this->info('Data imported successfully!');
    }
}