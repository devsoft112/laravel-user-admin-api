<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Log;

class MailService
{
    public function verifyUser(
        string $email
    ): void {
        Log::info("Sending verification mail to $email");
        sleep(rand(10, 200));
        Log::info("Verification mail sent to $email");
    }
}

