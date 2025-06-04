<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(Event $event) : JsonResponse
    {
        return response()->json($event);
    }
}
