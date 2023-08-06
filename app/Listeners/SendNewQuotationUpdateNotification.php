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
 
    //only particular Client will receive notification about the quotation confirmation
    public function handle($event)
    {
        //assign role to who will receive the notifications
        $clientRole = Role::where('role', 'Client')->first();

        if ($clientRole) {
            $clientUsers = $clientRole->users;
            Notification::send($clientUsers, new NewQuotationUpdateNotification($event->design));
        }
    } 
}
