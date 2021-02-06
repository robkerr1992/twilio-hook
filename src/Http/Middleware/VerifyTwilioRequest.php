<?php

namespace Rksugarfree\TwilioHook\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Twilio\Security\RequestValidator;

class VerifyTwilioRequest
{
    public function handle(Request $request, Closure $next)
    {
        $validator = new RequestValidator(config('twilio-hook.auth_token'));
        $ssl = config_path('twilio-hook.https') ? 'https' : 'http';
        $url = "$ssl://{$request->header('Host')}/twilio-hook/webhook";

        if(! $validator->validate($request->header('X-Twilio-Signature'), $url, $request->all())) {
            return response([], 403);
        }

        return $next($request);
    }
}
