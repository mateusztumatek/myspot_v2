<?php
namespace App\NotificationChannel;
use Illuminate\Validation\ValidationException;

interface NotificationChannelInterface{
    public function type() : string;

    public function meta() : array;

    /**
     * @param array $array
     * @throw ValidationException
     * @return mixed
     */
    public function validateData(array $array);
}
