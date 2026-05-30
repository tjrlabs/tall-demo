<?php

namespace App\Console\Commands;

use App\Mail\ReminderMail;
use App\Models\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send due reminder emails';

    public function handle(): void
    {
        $due = Reminder::query()
            ->with('post')
            ->whereNull('notified_at')
            ->join('posts', 'posts.id', '=', 'reminders.post_id')
            ->whereRaw("posts.event_at - (reminders.remind_before_minutes * interval '1 minute') <= now()")
            ->whereRaw("posts.event_at > now() - interval '1 hour'")
            ->select('reminders.*')
            ->get();

        foreach ($due as $reminder) {
            Mail::to($reminder->email)->send(new ReminderMail($reminder));
            $reminder->update(['notified_at' => now()]);
            $this->info("Sent reminder to {$reminder->email} for post #{$reminder->post_id}");
        }

        $this->info("Done. {$due->count()} reminder(s) sent.");
    }
}
