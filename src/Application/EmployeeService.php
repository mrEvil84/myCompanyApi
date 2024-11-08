<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Command\Employee\AddEmployee;
use App\Application\Command\Employee\EmployeeCommand;
use App\Application\Handlers\Employee\AddEmployeeHandler;
use App\Application\Handlers\Employee\ReplaceEmployeeHandler;
use App\Application\Handlers\Employee\UpdateEmployeeHandler;

readonly class CompanyEmployeeService
{
    public function __construct(
        private AddEmployeeHandler $addHandler,
        private ReplaceEmployeeHandler $replaceHandler,
        private UpdateEmployeeHandler $updateHandler,
        private DeleteEmployeeHandler $deleteHandler,
    ) {
    }

    public function addEmployee(AddEmployee $command): void
    {
        $this->addHandler->handle($command);
    }

    public function replaceEmployee(EmployeeCommand $command): void
    {
        $this->replaceHandler->handle($command);
    }

    public function updateEmployee(EmployeeCommand $command): void
    {
        $this->updateHandler->handle($command);
    }

    public function delete(int $employeeId): void
    {

    }
}
