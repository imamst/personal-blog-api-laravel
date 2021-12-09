<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function clear(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
                    'message' => 'Successfully logged out'
        ]);
    }
}
