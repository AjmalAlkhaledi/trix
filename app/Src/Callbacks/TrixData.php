<?php

namespace App\Src\Callbacks;

use App\Events\UpdateReceived;

/**
 * Use command : php artisan add:data {className}, to add a new class callback data
 *
 * @example: php artisan add:data TrixData
 */
class TrixData
{
    /**
     * Write your codes at this method
     *
     * This is class will call when {callback_query->data == 'Terix'}
     */
    public function __construct(UpdateReceived $event)
    {
        $callback = $event->updates()->callback_query;
        $message = $callback->message;
        $chat_id = $message->chat->id;
        $message_id = $message->message_id;

        $event->editMessageText([
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => 'Ok, Trix is easy.',
        ]);

    }
}
