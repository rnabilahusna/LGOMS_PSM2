<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\design;
use Illuminate\Support\Facades\Notification;
use App\Events\QuotationSubmitted;


class SendNewQuotationNotification
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
        
        $prodRole = Role::where('role', 'Production')->first();

        
        if ($prodRole) {
            $prodUsers = $prodRole->users;
            Notification::send($prodUsers, new NewQuotationNotification($event->design));
        }
       

    }


    
}
