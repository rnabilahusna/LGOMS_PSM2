<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\order;
use Illuminate\Support\Facades\Notification;
use App\Events\PaymentSubmitted;


class SendNewPaymentNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
 

    public function handle($event)
    {
        
        $salesRole = Role::where('role', 'Sales')->first();

        
        if ($salesRole) {
            $salesUsers = $salesRole->users;
            Notification::send($salesUsers, new NewPaymentNotification($event->order));
        }
       

    }


    
}
