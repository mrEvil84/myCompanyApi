<?php

declare(strict_types=1);

namespace App\Application\Handlers\Employee;

use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\DomainModel\EmployeeRepository;

final readonly class DeleteEmployeeHandler
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
    ) {
    }

    public function handle(int $employeeId): void
    {
        $this->assertEmployeeExists($employeeId);
        $this->employeeRepository->deleteEmployee($employeeId);
    }

    private function assertEmployeeExists(int $employeeId): void
    {
        if (!$this->employeeRepository->employeeExists($employeeId)) {
            throw CommandHandlerException::employeeNotFound();
        }
    }
}
