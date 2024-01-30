<?php

namespace App\Http\Responses\Fortify;

class LoginResponse implements \Laravel\Fortify\Contracts\LoginResponse{

    public function toResponse($request)
    {
        return response()->json($request->user());
    }
}
