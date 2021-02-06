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
        $url = config('twilio-hook.app_url').'/api/twilio-hook/webhook';

        if(! $validator->validate($request->header('X-Twilio-Signature'), $url, $request->all())) {
            return response([], 403);
        }

        return $next($request);
    }
}
