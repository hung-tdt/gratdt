<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CustomNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    // Chỉ sử dụng kênh "database"
    public function via($notifiable)
    {
        return ['database'];
    }

    // Dữ liệu sẽ lưu trong cột `data` của bảng `notifications`
    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
        ];
    }
}
