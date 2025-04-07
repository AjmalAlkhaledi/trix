<?php

namespace App\OrionTools;

use Illuminate\Support\Facades\Http;

class Bot
{
    private string $api_key;

    /**
     * Create a new class instance.
     */
    public function __construct(string $api_key)
    {
        $this->api_key = $api_key;
    }

    /**
     * Calls any method at instance Bot
     *
     * @param string method.
     * @param array arguments.
     * @return mixed.
     */
    public function __call(string $method, array $arguments): mixed
    {
        return $this->sendHttpRequest($method, $arguments[0]);
    }

    /**
     * Sends HTTP POST Request to Telegram Bot API.
     *
     * @param string method.
     * @param array data.
     * @return mixed.
     */
    private function sendHttpRequest(string $method, array $data): mixed
    {
        $response = Http::post(
            'https://api.telegram.org/bot'.$this->api_key.'/'.$method,
            $data
        );

        return $response->json();
    }
}
