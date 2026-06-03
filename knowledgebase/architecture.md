# Architecture

## Database schema

### posts
| Column | Type | Notes |
|--------|------|-------|
| id | bigIncrements | |
| title | string | event title |
| body | text | event description |
| event_at | timestamp, nullable | when the event starts — null until extracted by Gemini; can be rewound via /demo/reset |
| timestamps | | |

### reminders
| Column | Type | Notes |
|--------|------|-------|
| id | bigIncrements | |
| post_id | foreignId → posts | cascade delete |
| email | string | recipient email |
| remind_before_minutes | unsignedSmallInteger | 15, 30, or 60 |
| notified_at | timestamp, nullable | null = not yet sent; populated when email is sent |
| timestamps | | |

## Key files

```
app/
  Console/Commands/SendReminders.php   — artisan command: finds due reminders, sends emails
  Http/Controllers/PostController.php  — index (all posts) + show (single post via route model binding)
  Http/Controllers/DemoController.php  — /demo/reset?minutes=X rewinds the event clock
  Livewire/RemindModal.php             — open() extracts event date via Gemini if null, then opens modal; submit() creates reminder
  Mail/ReminderMail.php                — Mailable: sends reminder email with post details
  Models/Post.php                      — fillable: title, body, event_at; casts event_at to datetime
  Models/Reminder.php                  — fillable: post_id, email, remind_before_minutes, notified_at; casts notified_at
  Services/EventDateExtractor.php      — calls Gemini API (gemini-2.0-flash) to extract event date from post body; returns ISO datetime string or null

resources/views/
  posts/index.blade.php                — card listing of all posts
  posts/show.blade.php                 — single event page with banner (shows "Date TBA" if event_at is null)
  livewire/remind-modal.blade.php      — modal UI: "Remind me" button → wire:click="open" (triggers extraction), form, success state
  emails/reminder.blade.php            — email template
  prompts/event-date-extraction.md     — Gemini prompt template with {{today}} and {{body}} placeholders

routes/
  web.php                              — GET / → PostController::index; GET /posts/{post} → PostController::show; GET /demo/reset → DemoController::reset
  console.php                          — Schedule::command('reminders:send')->everyMinute()
```

## Reminder scheduling logic

`SendReminders` command runs every minute via the Laravel scheduler. It finds reminders where:
- `notified_at IS NULL` (not yet sent)
- `event_at - (remind_before_minutes * interval '1 minute') <= now()` (it is time to send)
- `event_at > now() - interval '1 hour'` (grace window — ignores events that ended over an hour ago)

## Duplicate guard

In `RemindModal::submit()`, before creating a reminder, the code checks if a reminder with the same `post_id` + `email` already exists with `notified_at IS NULL`. If so, it adds a Livewire validation error on the email field and returns early.

## AI event date extraction

`EventDateExtractor::extract(string $body)` is called from `RemindModal::open()` when `post.event_at` is null. It loads the prompt from `resources/prompts/event-date-extraction.md`, substitutes `{{today}}` and `{{body}}`, and POST-requests the Gemini API. On success it returns an ISO datetime string which is saved to `posts.event_at`. On any failure (bad API key, network error, no date found) it returns null silently — the modal still opens, the reminder is still created.

Extraction is done **once per post** — subsequent "Remind me" clicks skip the API because `event_at` is now non-null.

Requires `GEMINI_API_KEY` in `.env`.

## Demo reset route

`GET /demo/reset?minutes=X` updates `posts.event_at` to `now() + X minutes` and returns JSON. Use this during a live demo to make the event happen in 16 minutes, then set a 15-minute reminder, wait, and show the email arriving.
