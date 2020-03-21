<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Purchase extends Mailable
{
    use Queueable, SerializesModels;
    protected $title;
    protected $name;
    protected $address;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

        // $to = [
        // 	[
        // 		'name' => 'Laravel-rito',
        // 		'email' => 'test@gmail.com'
        // 	]
        // ];
        // $to = [
        // 	'test_01@mail.com',
        // 	'test_02@mail.com'
        // ];
        // $to = [
        // 	[
        // 		'name' => 'Laravel-01',
        // 		'email' => 'test_01@mail.com'
        // 	],
        // 	[
        // 		'name' => 'Laravel-02',
        // 		'email' => 'test_02@mail.com'
        // 	]
        // ];
        //$this->title = sprintf('%sさん、ありがとうございます。', $name);
        $this->title = 'ご購入ありがとうございました。';
        $this->name = 'テストだ王';
        $this->address = '東京';
        $this->data = [
            [
                'title' => 'Laravel-rito',
                'price' => 'test@gmail.com'
            ]
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.purchase')
            ->from('hoge@hoge.com')
            ->subject($this->title)
            ->with([
                'name' => $this->name,
                'address' => $this->address,
                'data' => $this->data,
            ]);
    }
}
