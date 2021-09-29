<?php

namespace App\Events;

use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class ProductAmountAdded extends ShouldBeStored
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $modelId;
    public float $amount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $modelId, float $amount)
    {
        $this->modelId = $modelId;
        $this->amount = $amount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
