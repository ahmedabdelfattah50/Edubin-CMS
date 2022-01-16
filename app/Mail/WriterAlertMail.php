<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WriterAlertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;       // ##### this to use the data of the user in the email blade
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        // ##### go to the email blade page
        return $this->view('dashboard.email.sendEmail');
    }
}
