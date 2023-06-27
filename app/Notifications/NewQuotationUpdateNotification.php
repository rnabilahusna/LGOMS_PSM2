<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewQuotationUpdateNotification extends Notification
{
    use Queueable;
    public $design;

    /**
     * Create a new notification instance.
     */
    public function __construct($design)
    {
        $this->design = $design;
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


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable)
    {
        return [
            'designID' => $this->design->designID,
            'partNo' => $this->design->partNo,
            'partDescription' => $this->design->partDescription,
            'designConfirmationStatus' => $this->design->designConfirmationStatus,
        ];
    }
}
