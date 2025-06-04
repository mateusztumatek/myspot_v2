<?php

namespace App\Http\Controllers;

use App\Contracts\SubscribeToEventInterface;
use App\Exceptions\EventAttendeeAlreadySubscribedException;
use App\Http\Resources\EventAttendeeResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class EventAttendeeController extends Controller
{
    public function index(Event $event) : JsonResource
    {
        return $event->attendees()->paginate(25)
            ->toResourceCollection(EventAttendeeResource::class);
    }

    public function subscribe(Event $event, Request $request, SubscribeToEventInterface $subscribeToEvent) : JsonResponse
    {
        try{
            $subscribeToEvent->subscribeEvent($event);
        }catch (EventAttendeeAlreadySubscribedException $exception){
            return response()->json([
                'message' => $exception->getMessage(),
            ], 422);
        }

        return response()->json(true);
    }
}
