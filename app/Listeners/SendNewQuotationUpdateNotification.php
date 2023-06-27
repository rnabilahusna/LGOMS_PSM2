<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\design;
use Illuminate\Support\Facades\Notification;
use App\Events\QuotationUpdated;


class SendNewQuotationUpdateNotification
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
        
        $clientRole = Role::where('role', 'Client')->first();

        
        if ($clientRole) {
            $clientUsers = $clientRole->users;
            Notification::send($clientUsers, new NewQuotationUpdateNotification($event->design));
        }
       

    }


    
}
