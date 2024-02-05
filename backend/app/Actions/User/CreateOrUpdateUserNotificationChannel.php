<?php

namespace App\Actions\User;

use App\Models\NotificationChannel;
use App\Models\User;
use App\NotificationChannel\NotificationChannelInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateOrUpdateUserNotificationChannel
{

    /**
     * Create a new job instance.
     */
    public function __construct(
        public int $user_id,
        public NotificationChannelInterface $notificationChannel,
        public bool $active = true,
        public ?int $notificationChannelId = null,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): NotificationChannel
    {
        $user = User::findOrFail($this->user_id);
        $channel = $user->notificationChannels()->updateOrCreate(
          ['id' => $this->notificationChannelId],
          ['active' => $this->active, 'channel' => $this->notificationChannel->type(), 'meta' => $this->notificationChannel->meta()]
        );
        return $channel;
    }
}
