<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendNewMail extends Mailable
{
    use Queueable, SerializesModels;

    private $title;
    private $restaurant;
    private $transaction;
    private $dishes;
    private $amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$restaurant,$transaction,$dishes,$amount)
    {
      $this->title = $title;
      $this->restaurant = $restaurant;
      $this->transaction = $transaction;
      $this->dishes = $dishes;
      $this->amount = $amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.newMail')
                    ->subject($this->title)
                    ->with('restaurant',$this->restaurant)
                    ->with('transaction',$this->transaction)
                    ->with('dishes',$this->dishes)
                    ->with('amount',$this->amount);

    }
}
