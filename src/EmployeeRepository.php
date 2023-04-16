<?php

namespace BirthdayGreetingsKata;

interface EmployeeRepository
{
    public function byBirthDay(XDate $xDate): array;
}