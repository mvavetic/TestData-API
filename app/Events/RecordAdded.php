<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RecordAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Table in which record was created
     *
     * @var $table
     */
    public $table;

    /**
     * ID of the new record
     *
     * @var $id
     */
    public $id;

    /**
     * Create a new event instance.
     *
     * @param $table
     * @param $id
     * @return void
     */
    public function __construct($table, $id)
    {
        $this->table = $table;
        $this->id = $id;
    }
}