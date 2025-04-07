<?php

namespace App\Src;

use App\Events\UpdateReceived;
use App\Src\Callbacks\TrixData;

class OnData
{
    /**
     * Entry point of {update->callback_query->data}
     */
    public function __construct(UpdateReceived $event)
    {
        $data = $event->updates()->callback_query->data;

        if ($data === 'Trix') {
            new TrixData($event);
        }

    }
}
