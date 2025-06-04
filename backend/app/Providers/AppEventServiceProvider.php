<?php

namespace App\Providers;

use App\Actions\Events\AuthenticatedUserEventSubscriber;
use App\Contracts\SubscribeToEventInterface;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppEventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(SubscribeToEventInterface::class, function (Application $app){
            // Subscriber for authenticated users
            if(auth()->check()){
                return resolve(AuthenticatedUserEventSubscriber::class);
            }
        });
    }
}
