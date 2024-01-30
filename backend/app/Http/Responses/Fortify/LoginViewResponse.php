<?php

namespace App\Http\Responses\Fortify;

use App\Consts\FrontRoutes;
use App\Helpers\RoutingHelper;

class LoginViewResponse implements \Laravel\Fortify\Contracts\LoginViewResponse {

    public function toResponse($request)
    {
        return redirect()->to(
            RoutingHelper::getFrontUrl(
                FrontRoutes::LOGIN
            )
        );
    }
}
