<?php

namespace App\Listeners\User;

use App\Actions\User\CreateOrUpdateUserNotificationChannel;
use App\Models\User;
use App\NotificationChannel\NotificationChannelInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateDefaultNotificationChannel
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        app()->makeWith(
            CreateOrUpdateUserNotificationChannel::class,
            [
                'user_id' => $event->user->id,
                'notificationChannelId' => null,
                'notificationChannel' => $this->createNotificationChannel($event),
                'active' => true
            ]
        )->handle();
    }

    public function createNotificationChannel($event) : NotificationChannelInterface{
        return app()->makeWith(NotificationChannelInterface::class, [
            'type' => 'email',
            'meta' => [
                'email' => $event->user->email
            ]
        ]);
    }
}
