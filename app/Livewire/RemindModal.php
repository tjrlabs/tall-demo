<?php

namespace App\Livewire;

use App\Models\Reminder;
use Livewire\Component;

class RemindModal extends Component
{
    public int $postId;
    public string $email = '';
    public int $remindBeforeMinutes = 15;
    public bool $submitted = false;

    protected array $rules = [
        'email' => 'required|email|max:255',
        'remindBeforeMinutes' => 'required|in:15,30,60',
    ];

    public function resetForm(): void
    {
        $this->reset('email', 'submitted');
        $this->remindBeforeMinutes = 15;
    }

    public function submit(): void
    {
        $this->validate();

        Reminder::create([
            'post_id' => $this->postId,
            'email' => $this->email,
            'remind_before_minutes' => $this->remindBeforeMinutes,
        ]);

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.remind-modal');
    }
}
