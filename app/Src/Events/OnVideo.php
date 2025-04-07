<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnVideo extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $video = $update->message->video->file_id;

        // your code
    }
}
