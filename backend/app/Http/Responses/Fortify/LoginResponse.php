<?php

namespace App\Http\Responses\Fortify;

use App\Http\Resources\User\UserResource;

class LoginResponse implements \Laravel\Fortify\Contracts\LoginResponse{

    public function toResponse($request)
    {
        return UserResource::make($request->user());
    }
}
