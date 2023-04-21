<?php

declare(strict_types=1);

namespace BirthdayGreetingsKata;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class BirthdayService
{
    public function __construct(private readonly EmployeeRepository $employeeRepository)
    {
    }

    public function sendGreetings(XDate $xDate, string $smtpHost, int $smtpPort): void
    {
        $employees = $this->employeeRepository->byBirthDay($xDate);

        foreach ($employees as $employee) {
            $birthdayGreet = BirthdayGreet::fromEmployee($employee);
            $this->sendMessage($smtpHost, $smtpPort, $birthdayGreet);
        }
    }

    protected function sendMessage(string $smtpHost, int $smtpPort, BirthdayGreet $birthdayGreet): void
    {
        // Create a mailer
        $mailer = new Mailer(
            Transport::fromDsn('smtp://' . $smtpHost . ':' . $smtpPort)
        );

        // Construct the message
        $msg = (new Email())
            ->subject($birthdayGreet->title())
            ->from($birthdayGreet->from())
            ->to($birthdayGreet->to())
            ->text($birthdayGreet->message());

        // Send the message
        $mailer->send($msg);
    }
}
