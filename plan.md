# Plan: AI-Powered Event Date Extraction

## Goal

When a user clicks "Remind me" for a post that has no `event_at`, automatically extract the event date and time from the post body using Gemini AI and store it in the DB. All subsequent requests use the stored value — Gemini is only called once per post.

---

## Order of Implementation

### Step 1 — Seed Posts Without event_at
**File:** `database/seeders/PostSeeder.php`

- Update the seeder to set `event_at = null` on seeded posts
- Post body should contain the event date/time in natural language prose (e.g. "Join us on July 15th at 10am for...")
- This is the trigger condition for the AI extraction flow

---

### Step 2 — Environment Setup
- Add `GEMINI_API_KEY` to `.env` and `.env.example`
- Add `GEMINI_API_KEY` to Railway environment variables (tall-demo service)

---

### Step 3 — EventDateExtractor Service
**File:** `app/Services/EventDateExtractor.php`

- Accepts the post body as a string
- Calls Gemini API (`gemini-2.0-flash`) via Laravel's HTTP client (no extra package needed)
- Prompt instructs Gemini to extract the event date and time and return strict JSON:
  ```json
  { "event_at": "2026-07-15T10:00:00" }
  ```
  or `null` if no date is found
- Parses the JSON response and returns a Carbon datetime or `null`
- All failures (API error, unparseable response, no date found) return `null` silently

---

### Step 4 — Wire Extractor into RemindModal
**File:** `app/Livewire/RemindModal.php`

Trigger extraction inside the `open()` method:

1. Check if `$post->event_at` is null
2. If null → call `EventDateExtractor::extract($post->body)`
3. If a date is returned → update `posts.event_at` in DB and refresh the local `$post` reference
4. If still null → proceed anyway (reminder can still be saved; scheduler will skip it until `event_at` is set)

This way:
- **1st click** — extraction runs, result is stored
- **All subsequent clicks** — `event_at` is already in DB, extractor is never called again

---

### Step 5 — Update Knowledgebase
After implementation:
- Update `knowledgebase/architecture.md` — add EventDateExtractor service, lazy extraction flow
- Update `knowledgebase/stack.md` — add Gemini API entry
- Update `knowledgebase/deployment.md` — add `GEMINI_API_KEY` to required env vars

---

## What Does NOT Change
- `event_at` column already exists — no new migration needed
- Reminder modal UI, scheduler, email sending — all untouched
- `/demo/reset` route — still works the same way
- No admin UI needed — posts are seeded

---

## Key Decisions
- **Trigger point:** Extraction runs on `RemindModal::open()`, not on submit
- **Gemini model:** `gemini-2.0-flash` — fast, cheap, free tier (1500 req/day)
- **HTTP client:** Laravel's built-in `Http` facade — no extra package
- **Failure mode:** Any error or missing date → `event_at` stays `null`, no exception thrown
- **Idempotency:** Once `event_at` is populated, extraction never runs again for that post
