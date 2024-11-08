<?php

declare(strict_types=1);

namespace App\Tests\Application\Shared;

use App\Application\Command\Employee\EmployeeCommand;
use App\Application\Shared\EmployeeDto;
use App\Application\Shared\EmployeeDtoFactory;
use PHPUnit\Framework\TestCase;

class EmployeeDtoFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $employeeCommand = new EmployeeCommand(
            1234,
            6,
            'John',
            'Doe',
            'john.doe@example.com',
            '345555678'
        );
        $sut = new EmployeeDtoFactory();

        $employeeDto = $sut->fromCommand($employeeCommand);

        self::assertInstanceOf(EmployeeDto::class, $employeeDto);
        self::assertEquals('1234', $employeeDto->getCompanyId());
        self::assertEquals('6', $employeeDto->getEmployeeId());
        self::assertEquals('John', $employeeDto->getName());
        self::assertEquals('Doe', $employeeDto->getSurname());
        self::assertEquals('john.doe@example.com', $employeeDto->getEmail());
        self::assertEquals('345555678', $employeeDto->getPhone());
    }
}

