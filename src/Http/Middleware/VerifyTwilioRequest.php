<?php

namespace Rksugarfree\TwilioHook\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Twilio\Security\RequestValidator;

class VerifyTwilioRequest
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->dontValidateRequests() || $this->requestIsValid($request)) {
            return $next($request);
        }

        info('Fail: '.$request->get('Body'));
        return response([], 403);
    }

    private function requestIsValid(Request $request): bool
    {
        $validator = resolve(RequestValidator::class);

        return $validator->validate(
            $request->header('X-Twilio-Signature'),
            "{$request->header('X-Forwarded-Proto')}://{$request->header('Host')}/twilio-hook/webhook",
            $request->all()
        );
    }

    /**
     * @return bool
     */
    private function dontValidateRequests(): bool
    {
        return !config('twilio-hook.dont_validate_requests');
    }
}
