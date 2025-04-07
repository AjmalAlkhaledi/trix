<?php

use App\Http\Controllers\ValidationUpdates;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response('Hello world !!');
});

/**
 * Routes with /api/bot{api_key}
 * Method: POST
 */
Route::post('/bot{api_key}', [ValidationUpdates::class, 'handler']);
