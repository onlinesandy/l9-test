<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function MarkAsRead($id) {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        return back();
    }

    public function markAsUnread($id) {
        $notification = auth()->user()->notifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsUnread();
        }
        return back();
    }

    public function markAllRead($id) {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}
