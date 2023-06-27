<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderDueNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->order->id,
            'buyerCode' => $this->order->buyerCode,
            'PONo' => $this->order->PONo,
            'deliveryDateETA' => $this->order->deliveryDateETA,
            'message' => 'You have an order due in 5 days.',
        ];
    }
}
