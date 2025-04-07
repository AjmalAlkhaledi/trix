<?php

namespace App\Src\Events;

use App\Events\UpdateReceived;

class OnAddNewChatMember extends Event
{
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $member = $update->message->add_new_chat_member;

        // your code
    }
}
