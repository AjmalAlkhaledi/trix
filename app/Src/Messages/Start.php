<?php

namespace App\Src\Messages;

use App\Events\UpdateReceived;
use App\OrionTools\Button;

/**
 * Use command : php artisan add:text {className}, to add a new class text
 *
 * @example: php artisan add:text Start
 */
class Start
{
    /**
     * Write your codes at this method
     *
     * This is class will call when {message->text == '/start'}
     */
    public function __construct(UpdateReceived $event)
    {
        $update = $event->updates();
        $message = $update->message;
        $chat_id = $message->chat->id;

        $event->sendMessage([
            'chat_id' => $chat_id,
            'text' => 'I am Trix !',
            'reply_markup' => Button::inline([
                [['text' => 'Test', 'callback_data' => 'Trix']],
            ]),
        ]);
    }
}
