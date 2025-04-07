<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnVoice extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $voice = $update->message->voice->file_id;

        // your code
    }
}
