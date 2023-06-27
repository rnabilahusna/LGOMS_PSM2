<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\OrderSubmitted;
use Illuminate\Auth\Notifications\NewOrderNotification;
use Illuminate\Auth\Listeners\SendNewOrderNotification;

use Illuminate\Auth\Events\QuotationSubmitted;
use Illuminate\Auth\Notifications\NewQuotationNotification;
use Illuminate\Auth\Listeners\SendNewQuotationNotification;

use Illuminate\Auth\Events\QuotationUpdated;
use Illuminate\Auth\Notifications\NewQuotationUpdateNotification;
use Illuminate\Auth\Listeners\SendNewQuotationUpdateNotification;

use Illuminate\Auth\Events\PaymentSubmitted;
use Illuminate\Auth\Notifications\NewPaymentNotification;
use Illuminate\Auth\Listeners\SendNewPaymentNotification;

use Illuminate\Auth\Events\PaymentUpdated;
use Illuminate\Auth\Notifications\NewPaymentUpdateNotification;
use Illuminate\Auth\Listeners\SendNewPaymentUpdateNotification;

use Illuminate\Auth\Events\OrderDue;
use Illuminate\Auth\Notifications\OrderDueNotification;
use Illuminate\Auth\Listeners\SendOrderDueNotification;

use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderSubmitted::class => [
            SendNewOrderNotification::class,
        ],
        QuotationSubmitted::class => [
            SendNewQuotationNotification::class,
        ],
        QuotationUpdated::class => [
            SendNewQuotationUpdateNotification::class,
        ],
        PaymentSubmitted::class => [
            SendNewPaymentNotification::class,
        ],
        PaymentUpdated::class => [
            SendNewPaymentUpdateNotification::class,
        ],
        OrderDue::class => [
            SendOrderDueNotification::class,
        ]

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
