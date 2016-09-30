<?php

namespace CodeDelivery\Events;

use CodeDelivery\Models\Geo;
use CodeDelivery\Models\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class GetLocationDeliveryman extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $geo;

    private $model;

    /**
     * Create a new event instance.
     * @param Geo $geo
     * @param Order $model
     */
    public function __construct(Geo $geo, Order $model)
    {
        $this->geo = $geo;
        $this->model = $model;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [$this->model->hash];
    }
}
