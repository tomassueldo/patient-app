<?php

namespace App\Jobs;

use App\Mail\ConfirmationEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendConfirmationEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $patient;

    public function __construct($patient)
    {
        $this->patient = $patient;
    }

    public function handle()
    {
        Mail::to($this->patient->email)->send(new ConfirmationEmail($this->patient));
    }
}
