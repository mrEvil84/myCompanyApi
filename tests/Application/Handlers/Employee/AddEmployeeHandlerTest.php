<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Employee;

use App\Application\Command\Employee\AddEmployee;
use App\Application\Handlers\Employee\AddEmployeeHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Application\Shared\EmployeeDtoFactory;
use App\Tests\Application\Handlers\HandlersBaseTestCase;
use PHPUnit\Framework\Attributes\Test;

class AddEmployeeHandlerTest extends HandlersBaseTestCase
{
    #[Test]
    public function shouldAddEmployee(): void
    {
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(true);
        $this->employeeRepoMock->expects(self::once())->method('employeeExistsInCompany')->willReturn(false);

        $sut = new AddEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());

        $sut->handle(new AddEmployee(
            1234,
            12,
            'John',
            'Doe',
            'john.doe@example.com',
            '1234345'
        ));
    }

    #[Test]
    public function shouldNotAddEmployeeWhenCompanyNotExists(): void
    {
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(false);

        $sut = new AddEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Company not found.');

        $sut->handle(new AddEmployee(
            1234,
            12,
            'John',
            'Doe',
            'john.doe@example.com',
            '1234345'
        ));
    }

    #[Test]
    public function shouldNotAddEmployeeWhenEmployeeAlreadyExists(): void
    {
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(true);
        $this->employeeRepoMock->expects(self::once())->method('employeeExistsInCompany')->willReturn(true);

        $sut = new AddEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Employee already exists in company.');

        $sut->handle(new AddEmployee(
            1234,
            12,
            'John',
            'Doe',
            'john.doe@example.com',
            '1234345'
        ));
    }
}
