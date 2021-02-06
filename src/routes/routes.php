<?php

use Illuminate\Support\Facades\Route;
use Rksugarfree\TwilioHook\Http\Controllers\IncomingRequestController;
use Rksugarfree\TwilioHook\Http\Middleware\VerifyTwilioRequest;

Route::post('/twilio-hook/webhook', [IncomingRequestController::class, 'store'])
    ->middleware([VerifyTwilioRequest::class, 'api'])
    ->name('twilio-hook.store');
