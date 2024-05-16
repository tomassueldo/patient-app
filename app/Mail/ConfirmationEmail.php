<?php

namespace App\Mail;

use App\Models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $patient;
    private mixed $emailVerificationToken;

    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    public function build()
    {
        return $this->subject('Confirmación de Registro')
            ->view('emails.confirmation')
            ->with([
                'patient' => $this->patient,
            ]);
    }
}
