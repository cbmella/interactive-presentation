<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class activeSlide  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $active_slide;
    public $player_id;

    public function __construct($active_slide, $player_id)
    {
        $this->active_slide = $active_slide;
        $this->player_id = $player_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('Player.' . $this->player_id);
    }
}
