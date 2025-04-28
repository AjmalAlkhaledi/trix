<?php

use App\Http\Controllers\ValidationUpdates;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Promise\Promise;


Route::get('/', function () {
    return response('Hello worlds !!');
});

/**
 * Routes with /api/bot{api_key}
 * Method: POST
 */
Route::post('/bot{api_key}', [ValidationUpdates::class, 'handler']);
