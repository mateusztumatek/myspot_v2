<?php

namespace App\Http\Responses\Fortify;

use App\Consts\FrontRoutes;
use App\Helpers\RoutingHelper;

class ResetPasswordResponse implements \Laravel\Fortify\Contracts\ResetPasswordViewResponse {

    public function toResponse($request)
    {
        return redirect()->to(
            RoutingHelper::getFrontUrl(
                FrontRoutes::RESET_PASSWORD,
                [
                    'token' => $request->route('token'),
                    'email' => $request->email
                ]
            )
        );
    }
}
