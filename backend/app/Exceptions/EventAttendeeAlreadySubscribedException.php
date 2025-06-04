<?php

namespace App\Exceptions;

use App\Models\Event;
use Exception;

class EventAttendeeAlreadySubscribedException extends Exception
{
    public function __construct(public Event $event)
    {
        $message = "The user is already subscribed to the event '{$event->name}'.";
        parent::__construct($message, 500, null);
    }
}
