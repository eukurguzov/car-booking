<?php

namespace App\Listeners;

use App\Events\BookingApproved;
use Illuminate\Support\Facades\Mail;

class SendConfirmationEmail
{
    /**
     * Handle the event.
     *
     * @param  BookingApproved  $event
     * @return void
     */
    public function handle(BookingApproved $event)
    {
        $order = $event->order;
        Mail::send('emails.booking', ['order' => $order], function ($m) use ($order) {
            $m->from('my@app.com', 'My Application');

            $m->to($order->email, $order->name)->subject('Booking was approved');
        });
    }
}
