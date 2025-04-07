<?php

namespace App\Events;

use App\OrionTools\Bot;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private object $updatesData;

    private array $data;

    private Bot $bot;

    /**
     * Create a new event instance.
     */
    public function __construct(object $updates, array $data = [])
    {
        $this->updatesData = $updates;
        $this->data = $data;
        $this->bot = new Bot($data['api_key']);
    }

    public function updates(): object
    {
        return $this->updatesData;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function isCallback(): bool
    {
        return \property_exists($this->updatesData, 'callback_query');
    }

    public function isMessage(): bool
    {
        return \property_exists($this->updatesData, 'message');
    }

    public function __call(string $method, array $args): mixed
    {
        return $this->bot->$method($args[0]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
