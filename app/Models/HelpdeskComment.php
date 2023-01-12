<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpdeskComment extends Model
{
    use HasFactory;

    protected $fillable = ['ticket_id','user_id','content','html'];

    public function ticket()
    {
        return $this->belongsToMany(HelpdeskTicket::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
