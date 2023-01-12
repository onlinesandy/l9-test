<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_room', 'from_id','to_id',
        'reply_to','message','type','file_id',
        'read_status','read_at', 'status',
    ];


    public function chat_file() {
        return $this->belongsTo(ChatFile::class,'file_id');
    }

}
