<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cart;
    public $total;

    public function __construct($user, $cart, $total)
    {
        $this->user = $user;
        $this->cart = $cart;
        $this->total = $total;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
            ->subject('Xác nhận đơn hàng của bạn')
            ->view('emails.order_confirmation');
    }
}
