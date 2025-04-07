<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnGame extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $game = $update->message->game;

        // your code
    }
}
