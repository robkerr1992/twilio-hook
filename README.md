#Twilio Hook
###Description
A quick solution for exposing URL for Twilio to route requests to.

###Installation
 
1. ``` composer require rksugarfree/twilio-hook ```
2. ``` php artisan vendor:publish ``` (select 'twilio-hook' key)
3. Fill out .env ``` TWILIO_AUTH_TOKEN ```
4. Fill out .env ``` APP_URL ```
5. Create your own implementation of ``` \Rksugarfree\TwilioHook\RequestHandler.php ```
6. Bind it in the service container ``` app/Providers/AppServiceProvider.php ```
7. Point webhook requests as ``` '${yourapp.url}/api/twilio-hook/webhook' ```
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

