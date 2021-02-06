<?php

namespace Rksugarfree\TwilioHook\Http\Controllers;

use Illuminate\Http\Request;
use Rksugarfree\TwilioHook\RequestHandler;

class IncomingRequestController extends Controller
{
    public function store(RequestHandler $requestHandler, Request $request)
    {
        $requestHandler->handle($request);

        return response();
    }
}