<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Employee;

use App\Application\Command\Employee\EmployeeCommand;
use App\Application\Handlers\Employee\UpdateEmployeeHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Application\Shared\EmployeeDtoFactory;
use App\Tests\Application\Handlers\HandlersBaseTestCase;
use PHPUnit\Framework\Attributes\Test;

class UpdateEmployeeHandlerTest extends HandlersBaseTestCase
{
    #[Test]
    public function shouldUpdateEmployee(): void
    {
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(true);
        $this->employeeRepoMock->expects(self::once())->method('employeeExists')->willReturn(true);

        $sut = new UpdateEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());
        $sut->handle(new EmployeeCommand(
            1234,
            12,
            'New John',
        ));
    }

    #[Test]
    public function shouldNotUpdateWhenCompanyNotExits(): void
    {
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(false);

        $sut = new UpdateEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Company not found.');
        $sut->handle(new EmployeeCommand(
            1234,
            12,
            'New John',
        ));
    }

    #[Test]
    public function shouldNotUpdateWhenEmployeeNotExists(): void
    {
        $this->companyRepoMock->expects(self::once())->method('companyExists')->willReturn(true);
        $this->employeeRepoMock->expects(self::once())->method('employeeExists')->willReturn(false);

        $sut = new UpdateEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Employee not exists in company.');

        $sut->handle(new EmployeeCommand(
            1234,
            12,
            'New John',
        ));
    }
}
