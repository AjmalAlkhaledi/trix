<?php

namespace App\Http\Controllers;

use App\Events\UpdateReceived;
use App\OrionTools\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ValidationUpdates extends Controller
{
    public function handler(Request $request, string $api_key)
    {
        try {
            event(new UpdateReceived(
                updates: Utils::arrayToObject($request->all()),
                data: [
                    'api_key' => $api_key,
                ]
            ));
        } catch (\Throwable $e) {
            Log::error('Throwable in UpdateReceiverController@handler: ' . $e->getMessage(),[
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            report($e);
        } finally {
            return response()->json([
                'status' => 'ok',
            ]);
        }
    }
}

