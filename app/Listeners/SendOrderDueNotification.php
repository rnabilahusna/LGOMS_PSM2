<?php

namespace App\Listeners;


use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Models\order;
use Illuminate\Support\Facades\Notification;
use App\Events\OrderDue;


class SendOrderDueNotification
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
        $storeRole = Role::where('role', 'Store')->first();
        $qcRole = Role::where('role', 'QC')->first();
        $prodRole = Role::where('role', 'Production')->first();

        if ($salesRole) {
            $salesUsers = $salesRole->users;
            Notification::send($salesUsers, new OrderDueNotification($event->order));
        }
        if ($storeRole) {
            $storeUsers = $storeRole->users;
            Notification::send($storeUsers, new OrderDueNotification($event->order));
        }
        if ($qcRole) {
            $qcUsers = $qcRole->users;
            Notification::send($qcUsers, new OrderDueNotification($event->order));
        }
        if ($prodRole) {
            $prodUsers = $prodRole->users;
            Notification::send($prodUsers, new OrderDueNotification($event->order));
        }
       

    }


    
}
