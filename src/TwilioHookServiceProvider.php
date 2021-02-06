<?php

namespace Rksugarfree\TwilioHook;

use Illuminate\Support\ServiceProvider;

class TwilioHookServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/twilio-hook.php' => config_path('twilio-hook.php'),
        ], 'twilio-hook');

        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');

    }

    public function register()
    {

    }
}