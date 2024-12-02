<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;


class OrderStatusNotification extends Notification
{
    private $orderId;
    private $orderNumber;
    private $orderStatus;

    // Constructor để truyền mã đơn hàng và trạng thái
    public function __construct($orderId, $orderNumber, $orderStatus)
    {
        $this->orderId = $orderId;
        $this->orderNumber = $orderNumber;
        $this->orderStatus = $orderStatus;
    }

    // Chỉ định kênh thông báo qua cơ sở dữ liệu
    public function via($notifiable)
    {
        return ['database'];
    }

    // Nội dung lưu trong cơ sở dữ liệu
    public function toArray($notifiable)
    {
        return [
            'message' => "Order #{$this->orderNumber}  {$this->orderStatus}.",
            'order_id' => $this->orderId,
        ];
    }
}
