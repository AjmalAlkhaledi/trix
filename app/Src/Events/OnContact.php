<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnContact extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $contact = $update->message->contact;

        // your code
    }
}
