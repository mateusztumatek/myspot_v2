<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventAttendee extends Model
{
    /** @use HasFactory<\Database\Factories\EventAttendeeFactory> */
    use HasFactory;

    protected $fillable = ['event_id', 'user_id', 'attendee_name', 'attendee_email', 'attendee_phone'];

    public function event() : BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
