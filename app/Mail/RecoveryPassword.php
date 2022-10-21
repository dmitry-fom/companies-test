<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class RecoveryPassword extends Mailable
{
    public function __construct(private $token)
    {}

    public function build()
    {
        return $this
            ->subject('Recovery Password Request')
            ->html(
<<<TXT

User ask to recovery password.
token to recovery password: $this->token
TXT
            );
    }
}
