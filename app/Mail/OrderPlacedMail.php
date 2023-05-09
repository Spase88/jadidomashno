<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Cart;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cook;
    public $gourmet;
    public $recipeName;
    public $quantity;
    public $price;

    public function __construct($cook, $gourmet, $recipeName, $quantity, $price)
    {
        $this->cook = $cook;
        $this->gourmet = $gourmet;
        $this->recipeName = $recipeName;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function build()
    {
        return $this->view('emails.order_placed')
                    ->subject('New Order Placed')
                    ->with([
                        'cookName' => $this->cook->name,
                        'gourmetName' => $this->gourmet->name,
                        'recipeName' => $this->recipeName,
                        'quantity' => $this->quantity,
                        'price' => $this->price,
                    ]);
    }

}
