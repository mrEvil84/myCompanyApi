<?php

declare(strict_types=1);

namespace App\Application\Handlers\Employee;

use App\Application\Command\Employee\EmployeeCommand;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Application\Shared\EmployeeDtoFactory;
use App\DomainModel\CompanyRepository;
use App\DomainModel\EmployeeRepository;

final readonly class UpdateEmployeeHandler
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private EmployeeRepository $employeeRepository,
        private EmployeeDtoFactory $employeeDtoFactory,
    ) {
    }

    public function handle(EmployeeCommand $command): void
    {
        $this->assertCompanyExists($command);
        $this->assertEmployeeExists($command);

        $this->employeeRepository->updateEmployee($this->employeeDtoFactory->fromCommand($command));
    }

    private function assertCompanyExists(EmployeeCommand $command): void
    {
        $companyExists = $this->companyRepository->companyExists($command->getCompanyId());
        if (!$companyExists) {
            throw CommandHandlerException::companyNotFound();
        }
    }

    private function assertEmployeeExists(EmployeeCommand $command): void
    {
        if (!$this->employeeRepository->employeeExists($command->getEmployeeId())) {
            throw CommandHandlerException::employeeNotFound();
        }
    }
}
