<?php

declare(strict_types=1);

namespace Tests\BirthdayGreetingsKata;

use BirthdayGreetingsKata\BirthdayGreet;
use BirthdayGreetingsKata\BirthdayService;

final class BirthdayServiceSpy extends BirthdayService
{
    public array $greetingsSent = [];

    public function sendMessage(string $smtpHost, int $smtpPort, BirthdayGreet $birthdayGreet): void
    {
        $this->greetingsSent[] = $birthdayGreet;
    }
}