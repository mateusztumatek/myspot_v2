<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Consts\Locale;
use App\Traits\HasNotificationChannels;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Translation\HasLocalePreference;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, HasLocalePreference, HasMedia
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        InteractsWithMedia,
        HasNotificationChannels,
        HasRoles
    ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'uuid',
        'avatar',
        'locale',
        'source'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'uuid' => 'string',
        'locale' => Locale::class
    ];

    public function preferredLocale()
    {
        return $this->locale->value;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('avatar')
            ->fit(Fit::Contain, 300, 300);
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->notificationChannels()->where('channel', 'push')->get()->map(function (NotificationChannel $channel) {
            return $channel->notificationChannel()->getToken();
        })->toArray();
    }
}
