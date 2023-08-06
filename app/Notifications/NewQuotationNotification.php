<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewQuotationNotification extends Notification
{
    use Queueable;
    public $design;
    
    //Create a new notification instance.
    public function __construct($design)
    {
        $this->design = $design;
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
            'designID' => $this->design->designID,
            'buyerCode' => $this->design->buyerCode,
        ];
    }
}
