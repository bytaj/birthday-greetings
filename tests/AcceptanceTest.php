<?php

declare(strict_types=1);

namespace Tests\BirthdayGreetingsKata;

use BirthdayGreetingsKata\BirthdayService;
use BirthdayGreetingsKata\CsvEmployeeRepository;
use BirthdayGreetingsKata\MailMessageSenderService;
use BirthdayGreetingsKata\XDate;
use GuzzleHttp\Client;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

final class AcceptanceTest extends TestCase
{

    private BirthdayService $service;

    #[Before]
    protected function startMailhog(): void
    {
        $employeeRepository = new CsvEmployeeRepository(__DIR__ . '/resources/employee_data.txt');
        $messageSenderService = new MailMessageSenderService();
        $this->service = new BirthdayService($employeeRepository, $messageSenderService);
    }

    #[After]
    protected function stopMailhog(): void
    {
        (new Client())->delete('http://mailhog:8025/api/v1/messages');
    }

    #[Test]
    public function willSendGreetings_whenItsSomebodysBirthday(): void
    {
        $this->service->sendGreetings(
            new XDate('2008/10/08')
        );

        $messages = $this->messagesSent();
        $this->assertCount(1, $messages, 'message not sent?');

        $message = $messages[0];
        $this->assertEquals('Happy Birthday, dear John!', $message['Content']['Body']);
        $this->assertEquals('Happy Birthday!', $message['Content']['Headers']['Subject'][0]);
        $this->assertCount(1, $message['Content']['Headers']['To']);
        $this->assertEquals('john.doe@foobar.com', $message['Content']['Headers']['To'][0]);
    }

    #[Test]
    public function willNotSendEmailsWhenNobodysBirthday(): void
    {
        $this->service->sendGreetings(
            new XDate('2008/01/01')
        );

        $this->assertCount(0, $this->messagesSent(), 'what? messages?');
    }

    private function messagesSent(): array
    {
        return json_decode(file_get_contents('http://mailhog:8025/api/v1/messages'), true);
    }
}
