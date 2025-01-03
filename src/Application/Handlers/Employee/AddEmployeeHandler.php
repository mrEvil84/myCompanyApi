<?php

declare(strict_types=1);

namespace App\Application\Handlers\Employee;

use App\Application\Command\Employee\EmployeeCommand;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\Application\Shared\EmployeeDtoFactory;
use App\DomainModel\CompanyRepository;
use App\DomainModel\EmployeeRepository;

final readonly class AddEmployeeHandler
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
        $this->assertEmployeeNotExists($command);

        $this->companyRepository->addEmployee($this->employeeDtoFactory->fromCommand($command));
    }

    private function assertCompanyExists(EmployeeCommand $command): void
    {
        $taxIdNumberExists = $this->companyRepository->companyExists($command->getCompanyId());
        if (!$taxIdNumberExists) {
            throw CommandHandlerException::companyNotFound();
        }
    }

    private function assertEmployeeNotExists(EmployeeCommand $command): void
    {
        if ($this->employeeRepository->employeeExistsInCompany($this->employeeDtoFactory->fromCommand($command))) {
            throw CommandHandlerException::employeeAlreadyExistsInCompany();
        }
    }
}
