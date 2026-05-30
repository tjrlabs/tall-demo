<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function reset(Request $request)
    {
        $minutes = max(1, (int) $request->query('minutes', 60));

        $post = Post::firstOrFail();
        $post->update(['event_at' => now()->addMinutes($minutes)]);

        return response()->json([
            'message' => "Event time reset. It will now start in {$minutes} minute(s).",
            'event_at' => $post->event_at->toDateTimeString(),
            'tip' => "Now select a reminder option shorter than {$minutes} minutes to test.",
        ]);
    }
}
