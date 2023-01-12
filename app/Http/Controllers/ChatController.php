<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use View;
use Str;
use App\Models\ChatRoom;
use App\Models\ChatFile;
use DB;
use Carbon;
use File;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $userList = DB::table('users as a')
            ->select('a.id as id', 'a.name as user_name', 'a.name as nickname', 'a.email as email', DB::raw('count( distinct b.id) as messageCount'))
            ->leftJoin('messages as b', function ($join) {
                $join
                    ->on('b.from_id', '=', 'a.id')
                    ->where('b.to_id', '=', auth()->user()->id)
                    ->where('b.read_status', 0)
                    ->where('b.read_at', null);
            })
            // ->distinct('b.chat_room')
            ->groupBy('a.id')
            // ->havingRaw()

            ->get();

        return view('chat.index', [
            'title' => 'Chat',
            'breadcrumb' => 'Chat Panel',
            'help_url' => '/help',
            'userList' => $userList,
        ]);
    }

    public function getUserChat(Request $request)
    {
        dd("dd");
        $from_id = auth()->user()->id;
        $to_id = $request->input('to_id');
        // $chats = json_decode(file_get_contents(resource_path() . '/assets/json/chats.json'), true);
        $chats = [];

        $chatRoom = ChatRoom::getChatRoom([$from_id, $to_id]);
        if ($chatRoom != '') {
            $chats = Message::where('chat_room', $chatRoom)
                ->where('status', 1)
                ->get();

            $unreadMsgs = Message::where('chat_room', $chatRoom)
                ->where('read_status', 0)
                ->where('from_id', $to_id)
                ->where('read_at', null)
                ->get();
            foreach ($unreadMsgs as $u_msg) {
                $u_msg->update(['read_status' => '1', 'read_at' => Carbon::now()]);
                event(new \App\Events\SeenChatMsg($u_msg));
            }
        }
        return View::make('chat.ajax.chat', ['chats' => $chats]);
    }

    public function sendMsg(Request $request)
    {
        // $from_id = $request->input('from_id');
        $from_id = auth()->user()->id;
        $to_id = $request->input('to_id');
        $reply_to = $request->input('reply_to');
        $message = $request->input('msg');
        $chatRoom = ChatRoom::getChatRoom([$from_id, $to_id]);
        if ($chatRoom == '') {
            $chatRoom = ChatRoom::createChatRoom([$from_id, $to_id]);
        }

        $fileId = 0;
        if ($request->hasFile('chat_file')) {
            $chat_file = $request->file('chat_file');
            $r_Path = resource_path();
            $file_path ='/assets/chat/file_storage/' . $chatRoom.'/';
            $destinationPath = $r_Path . $file_path;
            $originalFile = $chat_file->getClientOriginalName();
            $filename = Carbon::now()->timestamp .'-' . $originalFile;
            $c_file = ChatFile::create([
                'unique_name' => $file_path . $filename,
                'original_name' =>  $originalFile,
                'type' => 'image',
                'status' => 1,
            ]);
            $fileId =  $c_file->id;
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }
            $chat_file->move($destinationPath, $filename);
            if ($message == '') {
                $message = ' ';
            }
        }


        $m = Message::create([
            'chat_room' => $chatRoom,
            'from_id' => $from_id,
            'to_id' => $to_id,
            'reply_to' => $reply_to,
            'status' => 1,
            'type' => 'text',
            'file_id'=>$fileId,
            'message' => $message,
        ]);

        event(new \App\Events\SendChatMsg($m));

        return response()->json([
            'success' => true,
            'mid' => $m->id,
        ]);
    }

    public function delChatMsg(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'id' => 'required',
        ]);
        if ($id > 0) {
            $row = Message::find($id);
            $row->update(['status' => '0']);
            $msg = 'Message Deleted Successfully!!!!';
        }

        return response()->json([
            'success' => true,
            'msg' => 'Message Deleted Successfully',
            'data' => '',
        ]);
    }

    public function seenChatMsg(Request $request)
    {
        $msg = '';
        $id = $request->input('id');
        $validated = $request->validate([
            'id' => 'required',
        ]);
        if ($id > 0) {
            $row = Message::find($id);
            $row->update(['read_status' => '1', 'read_at' => Carbon::now()]);
            event(new \App\Events\SeenChatMsg($row));
        }
    }

    public function getchatUserList(Request $request)
    {
        $userList = DB::table('users as a')
            ->select('a.id as id', 'a.name as name', 'a.name as nickname', 'a.email as email', DB::raw('count( distinct b.id) as messageCount'), 'b.created_at as msg_time')
            ->leftJoin('messages as b', function ($join) {
                $join
                    ->on('b.from_id', '=', 'a.id')
                    ->where('b.to_id', '=', auth()->user()->id)
                    ->where('b.read_status', 0)
                    ->where('b.read_at', null);
            })
            // ->distinct('b.chat_room')
            ->groupBy('a.id')
            ->orderBy('b.created_at', 'DESC')
            // ->havingRaw()

            ->get();
        return View::make('chat.ajax.chat-user-list', ['users' => $userList]);
    }

    public function getchatContactList(Request $request)
    {
        $userList = User::all();
        return View::make('chat.ajax.chat-contact-list', ['users' => $userList]);
    }
}
