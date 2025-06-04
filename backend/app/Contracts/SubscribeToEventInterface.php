<?php
namespace App\Contracts;

use App\Models\Event;

interface SubscribeToEventInterface {
    public function subscribeEvent(Event $event) : void;
}
