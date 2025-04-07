<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnAudio extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $audio = $update->message->audio->file_id;

        // your code
    }
}
