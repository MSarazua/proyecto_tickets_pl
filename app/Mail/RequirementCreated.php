<?php
namespace App\Mail;

use App\Models\Requirement;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequirementCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $requirement;

    public function __construct(Requirement $requirement)
    {
        $this->requirement = $requirement;
    }

    public function build()
    {
        return $this->view('emails.requirement_created')
                    ->from('plticket59@gmail.com', 'PL Ticket')
                    ->subject('Nuevo Requerimiento Creado')
                    ->with(['requirement' => $this->requirement]);
    }
}