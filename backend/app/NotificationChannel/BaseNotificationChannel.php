<?php
namespace App\NotificationChannel;
abstract class BaseNotificationChannel implements NotificationChannelInterface
{
    public function __construct(array $data)
    {
        $this->validateData($data);
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
