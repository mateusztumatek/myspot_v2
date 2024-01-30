<?php

namespace App\Http\Responses\Fortify;

use App\Consts\FrontRoutes;
use App\Helpers\RoutingHelper;

class VerifyEmailResponse implements \Laravel\Fortify\Contracts\VerifyEmailResponse {

    public function toResponse($request)
    {
        return redirect()->to(
            RoutingHelper::getFrontUrl(
                FrontRoutes::DASHBOARD,
                [],
                1
            )
        );
    }
}
