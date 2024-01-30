<?php

namespace App\Providers;

use App\Http\Responses\Fortify\LoginResponse as MyLoginResponse;
use App\Http\Responses\Fortify\LoginViewResponse as MyLoginViewResponse;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\VerifyEmailResponse;
use App\Http\Responses\Fortify\VerifyEmailResponse as MyVerifyEmailResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(LoginResponse::class, MyLoginResponse::class);
        $this->app->bind(LoginViewResponse::class, MyLoginViewResponse::class);
        $this->app->bind(VerifyEmailResponse::class, MyVerifyEmailResponse::class);
    }
}
