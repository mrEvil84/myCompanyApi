<?php

declare(strict_types=1);

namespace App\Application\Handlers;

use App\Application\Command\Employee\AddEmployee;
use App\Application\Exceptions\AddEmployeeException;
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

    public function handle(AddEmployee $command): void
    {
        $this->assertCompanyExists($command);
        $this->assertEmployeeNotExists($command);

        $this->companyRepository->addEmployee($this->employeeDtoFactory->fromCommand($command));
    }

    private function assertCompanyExists(AddEmployee $command): void
    {
        $taxIdNumberExists = $this->companyRepository->companyTaxIdNumberExists($command->getTaxIdNumber());
        if (!$taxIdNumberExists) {
            throw AddEmployeeException::companyNotFound();
        }
    }

    private function assertEmployeeNotExists(AddEmployee $command): void
    {
        if ($this->employeeRepository->employeeExistsInCompany($this->employeeDtoFactory->fromCommand($command))) {
            throw AddEmployeeException::employeeAlreadyExistsInCompany();
        }
    }
}
