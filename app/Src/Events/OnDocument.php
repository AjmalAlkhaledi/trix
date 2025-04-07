<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnDocument extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $document = $update->message->document->file_id;

        // your code
    }
}
