<?php

namespace BirthdayGreetingsKata;

final readonly class EmployeeRepository
{
    public function __construct(private string $fileName)
    {
    }

    public function byBirthDay(XDate $xDate): array
    {
        $fileHandler = fopen($this->fileName, 'rb');
        fgetcsv($fileHandler);

        $employees = [];

        while ($employeeData = fgetcsv($fileHandler, null, ',')) {
            $employeeData = array_map('trim', $employeeData);
            $employee = new Employee($employeeData[1], $employeeData[0], $employeeData[2], $employeeData[3]);
            if ($employee->isBirthday($xDate)) {
                $employees[] = $employee;
            }
        }
        return $employees;
    }
}