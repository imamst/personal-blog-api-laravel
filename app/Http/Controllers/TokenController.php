<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helper\ApiHelper;

class TokenController extends Controller
{
    use ApiHelper;

    public function clear(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->onSuccess(null, 'Successfully logged out');
    }
}
