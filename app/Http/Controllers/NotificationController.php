<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::guard('customer')->user()->notifications()->orderBy('created_at', 'desc')->paginate(10);

        return view('customer.component.notifications', compact('notifications'));
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::guard('customer')->user()->notifications->find($notificationId);

        if ($notification) {
            $notification->markAsRead();
    
            if (isset($notification->data['order_id'])) {
                $orderId = $notification->data['order_id'];
    
                return redirect()->route('order.track', ['order' => $orderId]);
            }
        }

        return redirect()->route('notifications.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'customers' => 'required|array',
            'customers.*' => 'exists:customers,id',
        ]);

        $customers = Customer::whereIn('id', $request->customers)->get();
        $message = $request->message;

        foreach ($customers as $customer) {
            $customer->notify(new \App\Notifications\CustomNotification($message));
        }

        return redirect()->back()->with('success', 'Notification sent successfully!');
    }
}
