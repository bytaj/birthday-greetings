<?php

namespace BirthdayGreetingsKata;

final readonly class BirthdayGreet
{
    private const FROM = 'sender@here.com';
    private const SUBJECT = 'Happy Birthday!';

    public function __construct(
        private string $firstName,
        private string $email,
    ) {
    }

    public static function fromEmployee(Employee $employee): self
    {
        return new self($employee->getFirstName(), $employee->getEmail());
    }

    public function from(): string
    {
        return self::FROM;
    }

    public function to(): string
    {
        return $this->email;
    }

    public function title(): string
    {
        return self::SUBJECT;
    }

    public function message(): string
    {
        return sprintf('Happy Birthday, dear %s!', $this->firstName);
    }
}