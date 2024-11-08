<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Employee;

use App\Application\Command\Employee\EmployeeCommand;
use App\Application\Handlers\Employee\ReplaceEmployeeHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Application\Shared\EmployeeDtoFactory;
use App\Tests\Application\Handlers\HandlersBaseTestCase;
use PHPUnit\Framework\Attributes\Test;

class ReplaceEmployeeHandlerTest extends HandlersBaseTestCase
{
    #[Test]
    public function shouldReplaceEmployee(): void
    {
        $this->companyRepoMock->expects($this->once())->method('companyExists')->willReturn(true);
        $this->employeeRepoMock->expects($this->once())->method('employeeExists')->willReturn(true);
        $this->employeeRepoMock->expects($this->once())->method('replaceEmployee');

        $sut = new ReplaceEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());
        $sut->handle(new EmployeeCommand(
            12,
            1234,
            'John',
            'Doe',
            'john@doe.com',
            '123456789'
        ));
    }

    #[Test]
    public function shouldAddEmployee(): void
    {
        $this->companyRepoMock->expects($this->once())->method('companyExists')->willReturn(true);
        $this->employeeRepoMock->expects($this->once())->method('employeeExists')->willReturn(false);
        $this->companyRepoMock->expects($this->once())->method('addEmployee');

        $sut = new ReplaceEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());
        $sut->handle(new EmployeeCommand(
            12,
            1234,
            'John',
            'Doe',
            'john@doe.com',
            '123456789'
        ));
    }

    #[Test]
    public function shouldNotHandleWhenCompanyNotFound(): void
    {
        $this->companyRepoMock->expects($this->once())->method('companyExists')->willReturn(false);

        $sut = new ReplaceEmployeeHandler($this->companyRepoMock, $this->employeeRepoMock, new EmployeeDtoFactory());

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Company not found.');
        $sut->handle(new EmployeeCommand(
            12,
            1234,
            'John',
            'Doe',
            'john@doe.com',
            '123456789'
        ));
    }
}
