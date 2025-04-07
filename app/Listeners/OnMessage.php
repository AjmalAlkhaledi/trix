<?php

namespace App\Listeners;

use App\Events\UpdateReceived;
use App\Src\Events\OnAddNewChatMember;
use App\Src\Events\OnAudio;
use App\Src\Events\OnContact;
use App\Src\Events\OnDocument;
use App\Src\Events\OnGame;
use App\Src\Events\OnPhoto;
use App\Src\Events\OnPoll;
use App\Src\Events\OnVideo;
use App\Src\Events\OnVoice;
use App\Src\OnText;

class OnMessage
{
    /**
     * Handle the event.
     */
    public function handle(UpdateReceived $event): void
    {
        if (! $event->isMessage()) {
            return;
        }

        foreach (self::getUpdateAccessor() as $accessor => $class) {
            if (\property_exists($event->updates()->message, $accessor)) {
                new $class($event);
            }
        }
        
    }

    public static function getUpdateAccessor(): array
    {
        return [
            'text' => OnText::class,
            'photo' => OnPhoto::class,
            'video' => OnVideo::class,
            'audio' => OnAudio::class,
            'voice' => OnVoice::class,
            'document' => OnDocument::class,
            'contact' => OnContact::class,
            'poll' => OnPoll::class,
            'game' => OnGame::class,
            'add_new_chat_member' => OnAddNewChatMember::class,
        ];
    }
}
