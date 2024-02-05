<?php

namespace App\NotificationChannel;

use Illuminate\Support\Facades\Validator;

class MailNotificationChannel extends BaseNotificationChannel{
    protected string $email;
    public function type(): string
    {
        return 'mail';
    }

    public function meta(): array
    {
        return [
            'email' => $this->email
        ];
    }

    public function validateData(array $array)
    {
        Validator::validate($array, [
            'email' => ['email', 'required']
        ]);
    }
}
