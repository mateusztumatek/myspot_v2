<?php

namespace App\Http\Requests\User;

use App\NotificationChannel\NotificationChannelInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationChannelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', Rule::in(array_keys(config('notification-channels.available_channels')))],
            'meta' => ['array']
        ];
    }

    public function notificationChannel() : NotificationChannelInterface{
        return app()->makeWith(NotificationChannelInterface::class, [
            'type' => $this->type,
            'meta' => $this->meta
        ]);
    }

    public function prepareForValidation()
    {
        $this->merge(['meta' => [
            ...$this->meta,
            'device' => $this->header('user-agent')
        ]]);
    }
}
