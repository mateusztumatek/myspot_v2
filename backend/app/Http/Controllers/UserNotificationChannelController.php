<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateOrUpdateUserNotificationChannel;
use App\Http\Requests\User\NotificationChannelRequest;
use App\Http\Resources\User\NotificationChannelResource;
use Illuminate\Http\Request;

class UserNotificationChannelController extends Controller
{
    public function store(NotificationChannelRequest $request){
        return NotificationChannelResource::make(
            app()->makeWith(CreateOrUpdateUserNotificationChannel::class, [
                'user_id' => $request->user()->id,
                'notificationChannelId' => null,
                'notificationChannel' => $request->notificationChannel(),
                'active' => true
            ])->handle()
        );
    }
}
