<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HelpdeskTicket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'helpdesk_ticket';
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'ticket_no','title', 'description', 'content', 'html',
        'ticket_status_id', 'priority_id', 'client_id', 'project_id',
        'created_by', 'category_id', 'status', 'reopened_at', 'closed_at', 'last_activity'
    ];

    public function ticket_status() {
        return $this->belongsTo(HelpdeskStatus::class,'ticket_status_id');
    }

    public function created_by() {
        return $this->belongsTo(User::class,'created_by');
    }

    public function priority() {
        return $this->belongsTo(HelpdeskPriority::class);
    }

    public function client() {
        return $this->belongsTo(HelpdeskClient::class);
    }


    public function project() {
        return $this->belongsTo(HelpdeskProject::class);
    }

    public function category() {
        return $this->belongsTo(HelpdeskCategory::class);
    }
}
