<?php

declare(strict_types=1);

namespace Tests\BirthdayGreetingsKata;

use BirthdayGreetingsKata\BirthdayService;
use BirthdayGreetingsKata\CsvEmployeeRepository;
use BirthdayGreetingsKata\XDate;
use GuzzleHttp\Client;
use PHPUnit\Framework\Attributes\After;
use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

final class AcceptanceTest extends TestCase
{
    private const SMTP_HOST = 'mailhog';
    private const SMTP_PORT = 1025;

    private BirthdayServiceSpy $service;

    #[Before]
    protected function startMailhog(): void
    {
        $employeeRepository = new CsvEmployeeRepository(__DIR__ . '/resources/employee_data.txt');
        $this->service = new BirthdayServiceSpy($employeeRepository);
    }

    #[After]
    protected function stopMailhog(): void
    {
        (new Client())->delete('http://mailhog:8025/api/v1/messages');
        $this->service->greetingsSent = [];
    }

    #[Test]
    public function willSendGreetings_whenItsSomebodysBirthday(): void
    {
        $this->service->sendGreetings(
            new XDate('2008/10/08'),
            static::SMTP_HOST,
            static::SMTP_PORT
        );

        $this->assertCount(1, $this->service->greetingsSent);
        $this->assertEquals('Happy Birthday, dear John!', $this->service->greetingsSent[0]->message());
    }

    #[Test]
    public function willNotSendEmailsWhenNobodysBirthday(): void
    {
        $this->service->sendGreetings(
            new XDate('2008/01/01'),
            static::SMTP_HOST,
            static::SMTP_PORT
        );

        $this->assertEmpty($this->service->greetingsSent);
    }
}
