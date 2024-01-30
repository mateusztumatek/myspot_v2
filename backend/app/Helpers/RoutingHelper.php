<?php

namespace App\Helpers;

use App\Consts\FrontRoutes;

class RoutingHelper{

    /**
     * Retrieves the front URL based on the given FrontRoutes object.
     *
     * @param FrontRoutes $frontRoute The FrontRoutes object to retrieve the URL for.
     * @return string The front URL concatenated with the value from the FrontRoutes object.
     */
    public static function getFrontUrl(
        FrontRoutes $frontRoute,
        array $queryParams = [],
        bool $refreshUser = false
    ) : string{
        if($refreshUser) $queryParams['refreshUser'] = 1;
        return config('app.front_url') . $frontRoute->value . '?' . http_build_query($queryParams);
    }
}
