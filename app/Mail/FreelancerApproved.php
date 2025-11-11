<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FreelancerApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $freelancer;

    public function __construct(User $freelancer)
    {
        $this->freelancer = $freelancer;
    }

    public function build()
    {
        return $this->subject('Akun Anda Disetujui!')
                    ->markdown('emails.freelancers.approved');
    }
}
