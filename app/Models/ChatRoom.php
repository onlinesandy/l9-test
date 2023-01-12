<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;
use DB;

class ChatRoom extends Model
{
    use HasFactory;
    protected $table = 'chat_rooms';
    protected $fillable = ['chat_room', 'user_id', 'status'];


    public static function createChatRoom($userArr = [])
    {
        $chatRoom = '';

        if (count($userArr)) {
            $chatRoom = Str::random(6);
            foreach ($userArr as $user_id) {
                ChatRoom::create([
                    'chat_room' => $chatRoom,
                    'user_id' => $user_id,
                    'status' => 1,
                ]);
            }
        }

        return $chatRoom;
    }

    public static function getChatRoom($userArr = [])
    {
        $chatRoom = '';

        if (count($userArr) > 2) {
        } elseif (count($userArr) == 2) {
            [$from_id, $to_id] = $userArr;

            $totalUserCond = "2";

            if($from_id == $to_id){
                $totalUserCond = "1";
            }
            $checkRoom = DB::table('chat_rooms as a')
                ->select('a.chat_room',DB::raw('group_concat( distinct a.user_id) as user_id'), DB::raw('count( distinct a.user_id) as total_user'))
                ->join('chat_rooms as b', function ($join) use ($from_id, $to_id) {
                    $join
                        ->on('a.chat_room', '=', 'b.chat_room')
                        ->where(function ($query) use ($from_id, $to_id) {
                            $query->where('a.user_id', '=', $from_id)->orWhere('b.user_id', '=', $to_id);
                        })
                        ->where(function ($query) use ($from_id, $to_id) {
                            $query->where('b.user_id', '=', $from_id)->orWhere('a.user_id', '=', $to_id);
                        });
                })
                // ->distinct('a.chat_room')
                ->groupBy('a.chat_room')
                ->havingRaw("total_user = ".$totalUserCond)
                ->get();


            if (count($checkRoom)) {
                $chatRoom = $checkRoom[0]->chat_room;
            }
        }


        return $chatRoom;
    }
}
