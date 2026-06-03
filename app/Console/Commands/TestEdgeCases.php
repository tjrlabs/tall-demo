<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\EventDateExtractor;
use Illuminate\Console\Command;

class TestEdgeCases extends Command
{
    protected $signature = 'edge-cases:test {--from=9 : Start from this post ID} {--to=26 : End at this post ID}';
    protected $description = 'Run Gemini extraction on edge case posts and print results';

    public function handle(): void
    {
        $from = (int) $this->option('from');
        $to   = (int) $this->option('to');

        $posts = Post::whereBetween('id', [$from, $to])->orderBy('id')->get();
        $extractor = app(EventDateExtractor::class);
        $rows = [];

        foreach ($posts as $index => $post) {
            if ($index > 0) {
                sleep(4);
            }

            $this->line("Post {$post->id}: {$post->title}");

            $output     = null;
            $confidence = null;
            $status     = null;

            while (true) {
                try {
                    $result     = $extractor->extract($post->body);
                    $output     = $result['event_at'] ?? 'null';
                    $confidence = $result['confidence'];
                    $status     = 'ok';
                    break;
                } catch (\Throwable $e) {
                    $message = $e->getMessage();

                    if (preg_match('/Please retry in ([\d.]+)s/i', $message, $m)) {
                        $wait = (int) ceil((float) $m[1]) + 2;
                        $this->line("  Rate limited — sleeping {$wait}s…");
                        sleep($wait);
                        continue;
                    }

                    $output = 'ERROR: ' . $message;
                    $status = 'error';
                    break;
                }
            }

            $this->line("  → {$output}  (confidence: {$confidence})");

            $rows[] = [
                'id'         => $post->id,
                'title'      => $post->title,
                'result'     => $output,
                'confidence' => $confidence,
                'status'     => $status,
            ];
        }

        $this->newLine();
        $this->line('--- JSON ---');
        $this->line(json_encode($rows, JSON_PRETTY_PRINT));
    }
}
