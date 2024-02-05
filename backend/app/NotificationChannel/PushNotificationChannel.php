<?php

namespace App\NotificationChannel;

use Illuminate\Support\Facades\Validator;

class PushNotificationChannel extends BaseNotificationChannel{


    protected string $token;
    protected string $device;

    public function type(): string
    {
        return 'push';
    }

    public function meta(): array
    {
        return [
            'token' => $this->token,
            'device' => $this->device
        ];
    }

    public function validateData(array $array)
    {
        Validator::validate($array, [
            'token' => ['string', 'required'],
            'device' => ['string', 'required']
        ]);
    }

    public function getToken() : string{
        return $this->token;
    }
}
