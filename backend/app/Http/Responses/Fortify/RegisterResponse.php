<?php

namespace App\Http\Responses\Fortify;

use App\Http\Resources\User\UserResource;

class RegisterResponse implements \Laravel\Fortify\Contracts\RegisterResponse {

    public function toResponse($request)
    {
        return UserResource::make($request->user());
    }
}
