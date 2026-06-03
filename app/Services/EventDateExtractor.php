<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class EventDateExtractor
{
    /**
     * @return array{event_at: string|null, confidence: float}
     */
    public function extract(string $body): array
    {
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            throw new RuntimeException('GEMINI_API_KEY is not set.');
        }

        $template = file_get_contents(resource_path('prompts/event-date-extraction.md'));

        $prompt = str_replace(
            ['{{today}}', '{{body}}'],
            [now()->format('Y-m-d'), $body],
            $template
        );

        $response = Http::post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
            [
                'contents' => [['parts' => [['text' => $prompt]]]],
            ]
        );

        if (!$response->ok()) {
            $message = $response->json('error.message') ?? "HTTP {$response->status()}";
            Log::warning('EventDateExtractor: bad response', ['status' => $response->status(), 'message' => $message]);
            throw new RuntimeException("Gemini API error: {$message}");
        }

        $text = $response->json('candidates.0.content.parts.0.text');

        if (!$text) {
            throw new RuntimeException('Gemini returned an empty response.');
        }

        // Strip markdown code fences if Gemini wraps in them anyway
        $text = preg_replace('/```(?:json)?\s*([\s\S]*?)```/', '$1', trim($text));
        $data = json_decode(trim($text), true);

        return [
            'event_at'   => $data['event_at'] ?? null,
            'confidence' => isset($data['confidence']) ? (float) $data['confidence'] : 0.0,
        ];
    }
}
