<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPaymentNotification extends Notification
{
    use Queueable;
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    
    public function via(object $notifiable)
    {
        return ['database'];
    }


   //store all the data into notification table
    public function toArray(object $notifiable)
    {
        return [
            'id' => $this->order->id,
            'buyerCode' => $this->order->buyerCode,
            'PONo' => $this->order->PONo,
        ];
    }
}
