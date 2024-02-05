<?php

return [

    /**
     * Available notification channels in application
     */
    'available_channels' => [
        'email' => \App\NotificationChannel\MailNotificationChannel::class,
        'push' => \App\NotificationChannel\PushNotificationChannel::class
    ]
];
