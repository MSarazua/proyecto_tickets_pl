<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Requirement;
use Illuminate\Queue\SerializesModels;

class UserAssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;

    public $requirement;

    public function __construct(Requirement $requirement)
    {
        $this->requirement = $requirement;
    }

    public function build()
    {
        return $this->view('emails.user_assignment')
                    ->subject('Su solicitud ha sido asignada')
                    ->with(['requirement' => $this->requirement]);
    }
}
