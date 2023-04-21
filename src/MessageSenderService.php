<?php

namespace BirthdayGreetingsKata;

interface MessageSenderService
{
    public function sendMessage(BirthdayGreet $birthdayGreet): void;
}