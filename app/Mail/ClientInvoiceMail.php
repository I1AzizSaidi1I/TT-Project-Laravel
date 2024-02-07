<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ClientInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected User $client;
    public function __construct($client)
    {
        $this->client = $client;
    }
    
    public function build()
    {
        return $this->to($this->client->email)->subject('Client Invoice Mail')->view('mails.clientInvoiceMail');
    }


}
