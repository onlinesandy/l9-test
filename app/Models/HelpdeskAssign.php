<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HelpdeskAssign extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['ticket_id','user_id','created_by'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
