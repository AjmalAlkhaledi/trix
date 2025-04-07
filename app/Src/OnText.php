<?php

namespace App\Src;

use App\Events\UpdateReceived;
use App\Src\Messages\Start;

class OnText
{
    /**
     * Entry point of {update->message->text}
     */
    public function __construct(UpdateReceived $event)
    {
        $text = $event->updates()->message->text;

        if ($text === '/start') {
            new Start($event);
        }

    }
}
