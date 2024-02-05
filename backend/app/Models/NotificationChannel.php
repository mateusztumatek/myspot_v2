<?php

namespace App\Models;

use App\NotificationChannel\NotificationChannelInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Exceptions\NotificationChannelNotFoundException;

class NotificationChannel extends Model
{
    use HasFactory;

    protected $fillable = ['notifiable_id', 'notifiable_type', 'channel', 'meta', 'active'];

    protected $casts = [
        'active' => 'boolean',
        'meta' => 'array'
    ];

    public function notifiable() : MorphTo{
        return $this->morphTo('notifiable', 'notifiable_type', 'notifiable_id', 'id');
    }

    /**
     * @throw NotificationChannelNotFoundException
     * @return NotificationChannelInterface
     */
    public function notificationChannel() : NotificationChannelInterface{
        return app()->makeWith(NotificationChannelInterface::class, ['type' => $this->channel, 'meta' => $this->meta]);
    }
}
