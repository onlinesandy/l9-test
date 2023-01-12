<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class SendChatMsg implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $msg;
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('Chat-'.$this->msg->to_id);
    }

    public function broadcastAs()
    {
        return 'Chat';
    }

    public function broadcastWith()
    {
        $unreadMsgs = Message::where('chat_room',$this->msg->chat_room)
        ->where('read_status',0)
        ->where('from_id',$this->msg->from_id)
        ->where('to_id',$this->msg->to_id)
        ->where('read_at',null)->count();
        return [
            "from"=>auth()->user()->name,
            "msg"=>$this->msg,
            "messageCount"=>$unreadMsgs,
        ];
    }
}
