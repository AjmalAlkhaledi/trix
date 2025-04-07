<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnPhoto extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $photos = $update->message->photo;

        $largePhoto = $photos[2]->file_id;
        $midPhoto = $photos[1]->file_id;
        $smallPhoto = $photos[0]->file_id;

        // your code
    }
}
