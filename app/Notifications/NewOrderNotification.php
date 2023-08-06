<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    use Queueable;
    public $order;

    //Create a new notification instance.
    public function __construct($order)
    {
        $this->order = $order;
    }

    //Get the notification's delivery channels.
    public function via(object $notifiable)
    {
        return ['database'];
    }


    //the attributes that will be store in notification table 
    public function toArray(object $notifiable)
    {
        return [
            'id' => $this->order->id,
            'buyerCode' => $this->order->buyerCode,
            'PONo' => $this->order->PONo,
            'deliveryDateETA' => $this->order->deliveryDateETA,
        ];
    }
}
