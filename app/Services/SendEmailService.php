<?php

namespace App\Services;

use App\Mail\WelcomeUser;
use Illuminate\Support\Facades\Mail;

class SendEmailService
{
    public function sendEmail(array $data): void
    {
        Mail::to(
            data_get($data, 'email'),
            data_get($data, 'name')
        )->send(new WelcomeUser($data));
    }
}
