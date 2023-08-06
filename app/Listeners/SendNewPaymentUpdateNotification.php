<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\order;
use Illuminate\Support\Facades\Notification;
use App\Events\PaymentUpdated;


class SendNewPaymentUpdateNotification
{
    

    public function handle($event)
    {
        
        $clientRole = Role::where('role', 'Client')->first();

        
        if ($clientRole) {
            $clientUsers = $clientRole->users;
            Notification::send($clientUsers, new NewPaymentUpdateNotification($event->order));
        }
       

    }


    
}
