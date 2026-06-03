<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Reminder;
use App\Services\EventDateExtractor;
use Livewire\Component;

class RemindModal extends Component
{
    public ?int $postId = null;
    public string $email = '';
    public int $remindBeforeMinutes = 15;
    public bool $submitted = false;
    public bool $extracting = false;
    public ?string $extractionError = null;

    protected array $rules = [
        'email' => 'required|email|max:255',
        'remindBeforeMinutes' => 'required|in:15,30,60',
    ];

    public function open(): void
    {
        $this->extractionError = null;
        $this->extracting = false;
        $this->submitted = false;
        $this->reset('email');
        $this->remindBeforeMinutes = 15;

        $post = Post::find($this->postId);

        if ($post && is_null($post->event_at)) {
            $this->extracting = true;
            $this->dispatch('start-extraction');
        }

        $this->dispatch('modal-ready');
    }

    public function extract(): void
    {
        $post = Post::find($this->postId);

        if (!$post) {
            $this->extracting = false;
            $this->extractionError = 'Event not found.';
            return;
        }

        if (!is_null($post->event_at)) {
            $this->extracting = false;
            return;
        }

        try {
            $result = app(EventDateExtractor::class)->extract($post->body);
        } catch (\Throwable $e) {
            $this->extracting = false;
            $this->extractionError = $e->getMessage();
            return;
        }

        $this->extracting = false;

        if (!$result['event_at']) {
            $this->extractionError = 'Gemini could not find a date/time in the event description.';
            return;
        }

        $post->update(['event_at' => $result['event_at']]);
    }

    public function submit(): void
    {
        $this->validate();

        $alreadyPending = Reminder::where('post_id', $this->postId)
            ->where('email', $this->email)
            ->whereNull('notified_at')
            ->exists();

        if ($alreadyPending) {
            $this->addError('email', 'A reminder for this email is already pending for this event.');
            return;
        }

        Reminder::create([
            'post_id'              => $this->postId,
            'email'                => $this->email,
            'remind_before_minutes' => $this->remindBeforeMinutes,
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.remind-modal', [
            'post' => Post::find($this->postId),
        ]);
    }
}
