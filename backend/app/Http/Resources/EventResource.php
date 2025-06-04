<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Event
 */
class EventResource extends JsonResource
{
    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'userAlreadySubscribed' => $this->when(auth()->check(), function (){
                return $this->attendees()
                    ->orWhere('attendee_email', auth()->user()->email)
                    ->orWhere('user_id', auth()->id())
                    ->first();
            }, null)
        ];
    }
}
