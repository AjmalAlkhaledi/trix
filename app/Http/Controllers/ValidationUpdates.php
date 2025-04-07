<?php

namespace App\Http\Controllers;

use App\Events\UpdateReceived;
use App\OrionTools\Utils;
use Illuminate\Http\Request;

class ValidationUpdates extends Controller
{
    public function handler(Request $request, string $api_key)
    {
        event(new UpdateReceived(
            updates: Utils::arrayToObject($request->all()),
            data: [
                'api_key' => $api_key,
            ]
        ));

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
