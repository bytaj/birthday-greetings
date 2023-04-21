<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

final readonly class BirthdayService
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private MessageSenderService $messageService
    ) {
    }

    public function sendGreetings(XDate $xDate): void
    {
        $employees = $this->employeeRepository->byBirthDay($xDate);

        foreach ($employees as $employee) {
            $birthdayGreet = BirthdayGreet::fromEmployee($employee);
            $this->messageService->sendMessage($birthdayGreet);
        }
    }
}
