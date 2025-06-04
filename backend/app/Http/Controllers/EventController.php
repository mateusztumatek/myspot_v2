<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(Event $event) : EventResource
    {
        return EventResource::make($event->load('attendees'));
    }
}
