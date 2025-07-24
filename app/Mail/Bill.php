<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Bill extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject("Hóa đơn đơn hàng #{$this->order->id}")
            ->markdown('emails.bill')
            ->with([
                'order' => $this->order,
                'details' => $this->order->orderDetails,
            ]);
    }
}
