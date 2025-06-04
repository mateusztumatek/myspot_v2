<?php

namespace App\Actions\Events;

use App\Contracts\SubscribeToEventInterface;
use App\Events\EventAttendeeSubscribed;
use App\Exceptions\EventAttendeeAlreadySubscribedException;
use App\Models\Event;
use App\Models\EventAttendee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event as EventAlias;

class AuthenticatedUserEventSubscriber implements SubscribeToEventInterface
{
    public function subscribeEvent(Event $event): void
    {
        DB::transaction(function () use ($event) {
            /**
             * @var User $user
             */
            $user = Auth::user();

            $attendee = $event->attendees()->make([
                'user_id' => Auth::id(),
                'attendee_name' => $user->name,
                'attendee_email' => $user->email,
                'attendee_phone' => null,
                'status' => 'subscribed',
            ]);

            if($this->checkIfAttendeeIsAlreadyAssignedToEvent($attendee)){
                throw new EventAttendeeAlreadySubscribedException($event);
            }

            $attendee->save();
            $event->validateAttendeesCount();

            EventAlias::dispatch(new EventAttendeeSubscribed($event, $attendee));
        });
    }

    protected function checkIfAttendeeIsAlreadyAssignedToEvent(EventAttendee $attendee) : bool
    {
        return $attendee->event->attendees()
            ->where('user_id', Auth::id())
            ->orWhere('attendee_email', $attendee->attendee_email)
            ->exists();
    }
}
