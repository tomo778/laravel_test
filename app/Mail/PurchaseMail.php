<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->title = sprintf('【%s】ご注文ありがとうございます', config('const.site_name'));
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $session_purchase = session('purchase');
        $session_cart = session('cart');
        return $this
            ->text('emails.purchase')
            //->view('emails.purchase')
            //->markdown('emails.test')
            ->from(config('const.mail'))
            ->subject($this->title)
            ->with([  
                'date' => $session_purchase['date'],
                'user_name' => $session_purchase['user_name'],
                'address_datas' => $session_purchase['address_datas'],
                'order_id' => $session_purchase['order_id'],
                'payway' => $session_purchase['payway'],
                'items' => $session_cart['items'],
                'price' => $session_cart['price'],
            ]);
    }
}
