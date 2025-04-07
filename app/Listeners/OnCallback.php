<?php

namespace App\Listeners;

use App\Events\UpdateReceived;
use App\Src\OnData;

class OnCallback
{
    /**
     * Handle the event.
     */
    public function handle(UpdateReceived $event): void
    {
        if (! $event->isCallback()) {
            return;
        }

        if (\property_exists($event->updates()->callback_query, 'data')) {
            new OnData($event);

            return;
        }
    }
}
