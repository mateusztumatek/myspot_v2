<?php
namespace App\Traits;
use App\Models\NotificationChannel;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasNotificationChannels{
    public function notificationChannels() : MorphMany{
        return $this->morphMany(NotificationChannel::class, 'notifiable');
    }
}
