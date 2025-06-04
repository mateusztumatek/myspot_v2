<?php

namespace App\Exceptions;

use App\Models\Event;
use Exception;

class EventMaxAttendeesExceededException extends Exception
{
    public function __construct(public Event $event)
    {
        $message = "The maximum number of attendees for the event '{$event->name}' has been exceeded.";
        parent::__construct($message, 500, null);
    }
}
