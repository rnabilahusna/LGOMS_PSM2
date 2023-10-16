<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPaymentUpdateNotification extends Notification
{
    use Queueable;
    public $order;

    /**
     * Create a new notification instance.
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable)
    {
        return ['database'];
    }


    //all the data to insert in the notification table in db
    public function toArray(object $notifiable)
    {
        return [
            'id' => $this->order->id,
            'PONo' => $this->order->PONo,
            'partNo' => $this->order->partNo,
            'partDescription' => $this->order->partDescription,
            'paymentStatus' => $this->order->paymentStatus,
        ];
    }
}
