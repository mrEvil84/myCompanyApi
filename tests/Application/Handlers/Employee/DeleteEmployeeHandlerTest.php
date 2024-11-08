<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Employee;

use App\Application\Handlers\Employee\DeleteEmployeeHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Tests\Application\Handlers\HandlersBaseTestCase;
use PHPUnit\Framework\Attributes\Test;

class DeleteEmployeeHandlerTest extends HandlersBaseTestCase
{
    #[Test]
    public function shouldDeleteEmployee(): void
    {
        $employeeId = 1234;

        $this->employeeRepoMock->expects($this->once())->method('employeeExists')->with($employeeId)->willReturn(true);
        $this->employeeRepoMock->expects($this->once())->method('deleteEmployee')->with($employeeId);

        $sut = new DeleteEmployeeHandler($this->employeeRepoMock);
        $sut->handle($employeeId);
    }

    #[Test]
    public function shouldNotDeleteWhileEmployeeNotExists(): void
    {
        $employeeId = 1234;

        $this->employeeRepoMock->expects($this->once())->method('employeeExists')->with($employeeId)->willReturn(false);

        $sut = new DeleteEmployeeHandler($this->employeeRepoMock);

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Employee not exists in company.');
        $sut->handle($employeeId);
    }
}
