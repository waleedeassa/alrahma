<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RestPassword extends Mailable
{
  use Queueable, SerializesModels;

  public $actionURL;

  public function __construct($actionURL)
  {
    $this->actionURL = $actionURL;
  }

  public function build()
  {

    return $this->subject("إعادة تعيين كلمة المرور")
      ->view('emails.reset-password')->with([
        'actionURL' => $this->actionURL,
      ]);
  }
}
