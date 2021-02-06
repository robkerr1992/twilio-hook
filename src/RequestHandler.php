<?php

namespace Rksugarfree\TwilioHook;

use Illuminate\Http\Request;

interface RequestHandler
{
    public function handle(Request $request);
}