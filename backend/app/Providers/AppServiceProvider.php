<?php

namespace App\Providers;

use App\Actions\Fortify\ResetUserPassword;
use App\Consts\OauthLoginProvider;
use App\Http\Responses\Fortify\LoginResponse as MyLoginResponse;
use App\Http\Responses\Fortify\LoginViewResponse as MyLoginViewResponse;
use App\NotificationChannel\NotificationChannelInterface;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\ResetPasswordViewResponse;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Laravel\Fortify\Contracts\VerifyEmailResponse;
use App\Http\Responses\Fortify\VerifyEmailResponse as MyVerifyEmailResponse;
use App\Http\Responses\Fortify\ResetPasswordResponse as MyResetPasswordResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerNotificationChannelFactory();

        $this->app->register(AppEventServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }

    public function registerNotificationChannelFactory(){
        /**
         * @param array $parameters {type: string, meta: array}
         */
        $this->app->bind(NotificationChannelInterface::class, function ($app, $parameters){
            return app()->makeWith(
                config('notification-channels.available_channels.'.$parameters['type']),
                ['data' => $parameters['meta']]
            );
        });
    }
}
