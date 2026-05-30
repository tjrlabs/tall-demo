<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Reminder</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #f4f4f5; margin: 0; padding: 32px 16px; color: #111827; }
        .card { max-width: 520px; margin: 0 auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        .header { background: linear-gradient(135deg, #6366f1, #8b5cf6); padding: 36px 32px; text-align: center; }
        .header svg { margin-bottom: 12px; }
        .header h1 { color: #fff; font-size: 20px; font-weight: 700; margin: 0; }
        .body { padding: 32px; }
        .badge { display: inline-block; background: #eef2ff; color: #4f46e5; font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 999px; margin-bottom: 16px; }
        .title { font-size: 18px; font-weight: 700; color: #111827; margin: 0 0 8px; }
        .meta { font-size: 14px; color: #6b7280; margin: 0 0 24px; }
        .divider { border: none; border-top: 1px solid #f3f4f6; margin: 24px 0; }
        .footer { font-size: 12px; color: #9ca3af; text-align: center; padding: 0 32px 24px; }
    </style>
</head>
<body>
<div class="card">
    <div class="header">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
        </svg>
        <h1>Event Reminder</h1>
    </div>
    <div class="body">
        @php
            $post = $reminder->post;
            $mins = $reminder->remind_before_minutes;
            $label = $mins === 60 ? '1 hour' : "{$mins} minutes";
        @endphp

        <span class="badge">
            Starts in {{ $label }}
        </span>

        <p class="title">{{ $post->title }}</p>
        <p class="meta">
            📅 {{ $post->event_at->format('l, F j, Y') }} at {{ $post->event_at->format('g:i A') }}
        </p>

        <p style="font-size:14px;color:#374151;line-height:1.6;margin:0;">
            Hi there! You asked us to remind you about this event.
            It kicks off in <strong>{{ $label }}</strong> — don't miss it!
        </p>

        <hr class="divider">
    </div>
    <div class="footer">
        You're receiving this because you signed up for a reminder on our site.<br>
        &copy; {{ date('Y') }} TJR Events Demo
    </div>
</div>
</body>
</html>
