<?php

namespace BirthdayGreetingsKata;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

final readonly class MailMessageSenderService implements MessageSenderService
{
    private const SMTP_HOST = 'mailhog';
    private const SMTP_PORT = 1025;

    private Mailer $mailer;

    public function __construct()
    {
        $this->mailer = new Mailer(
            Transport::fromDsn('smtp://' . self::SMTP_HOST . ':' . self::SMTP_PORT)
        );
    }

    public function sendMessage(BirthdayGreet $birthdayGreet): void
    {
        $msg = (new Email())
            ->subject($birthdayGreet->title())
            ->from($birthdayGreet->from())
            ->to($birthdayGreet->to())
            ->text($birthdayGreet->message());

        // Send the message
        $this->mailer->send($msg);
    }
}