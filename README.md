# Twilio Hook #
### Description ###
A quick solution for exposing a URL for Twilio to route requests to in a Laravel 8+ App

### Installation ###
 
1. ``` composer require rksugarfree/twilio-hook ```
2. ``` php artisan vendor:publish ``` (select 'twilio-hook' key)
3. Fill out .env ``` TWILIO_AUTH_TOKEN ```
5. Create your own implementation of ``` \Rksugarfree\TwilioHook\RequestHandler.php ```
6. Bind it in the service container ``` app/Providers/AppServiceProvider.php ```
7. Point webhook requests to ``` '${yourapp.url}/api/twilio-hook/webhook' ```
```
app/Models/${YourClassThatImplementsRequestHandler}.php

use Illuminate\Http\Request;
use Rksugarfree\TwilioHook\RequestHandler;

class ${YourClassThatImplementsRequestHandler} implements RequestHandler
{
    public function handle(Request $request)
    {
        //handle your request here
    }
}

```

```
app/Providers/AppServiceProvider.php

public function register()
{
    $this->app->bind(
        \Rksugarfree\TwilioHook\RequestHandler::class,
        \App\Models\${YourClassThatImplementsRequestHandler}::class
    );
} 

```

### Validating Requests ###

Requests are not validated by default. To enable this feature follow these steps.
1. Turn on validation in twilio-hook.php ``` 'validate_requests' => true ```
2. Bind the RequestValidator in the container
``` 
app/Providers/AppServiceProvider.php

use Twilio\Security\RequestValidator;

$this->app->singleton(
    RequestValidator::class,
    function ($app) {
        return new RequestValidator(config('twilio-hook.auth_token'));
    }
);
```
