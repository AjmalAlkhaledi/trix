<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnPoll extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $poll = $update->message->poll;

        // your code
    }
}
