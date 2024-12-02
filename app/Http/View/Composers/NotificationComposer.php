<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationComposer
{
    public function compose(View $view)
    {
        $user = Auth::guard('customer')->user();

        if ($user) {
            $unreadNotifications = $user->notifications()->whereNull('read_at')->get(); 
            $readNotifications = $user->notifications()->whereNotNull('read_at')->orderBy('read_at', 'desc')->take(5)->get(); 
    
            $view->with([
                'unreadNotifications' => $unreadNotifications,
                'readNotifications' => $readNotifications,
            ]);
        } else {
            $view->with([
                'unreadNotifications' => collect(),
                'readNotifications' => collect(),
            ]);
        }
    }
}