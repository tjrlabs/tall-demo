<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'event_at'];

    protected $casts = [
        'event_at' => 'datetime',
    ];

    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }
}
