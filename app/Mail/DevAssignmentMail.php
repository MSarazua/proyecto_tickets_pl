<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Requirement;

class DevAssignmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $requirement;

    public function __construct(Requirement $requirement)
    {
        $this->requirement = $requirement;
    }

    public function build()
    {
        return $this->view('emails.dev_assignment')
                    ->subject('Nueva solicitud asignada')
                    ->with(['requirement' => $this->requirement]);
    }
}
