<?php

declare(strict_types=1);

namespace App\Application\Handlers\Employee;

use App\Application\Command\Employee\ReplaceEmployee;
use App\Application\Exceptions\AddEmployeeException;
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

    public function handle(ReplaceEmployee $command): void
    {
        $this->assertCompanyExists($command);
        $this->assertEmployeeExists($command);

        $this->employeeRepository->replaceEmployee($this->employeeDtoFactory->fromCommand($command));
    }

    private function assertCompanyExists(ReplaceEmployee $command): void
    {
        $taxIdNumberExists = $this->companyRepository->companyTaxIdNumberExists($command->getTaxIdNumber());
        if (!$taxIdNumberExists) {
            throw AddEmployeeException::companyNotFound();
        }
    }

    private function assertEmployeeExists(ReplaceEmployee $command): void
    {
        if (!$this->employeeRepository->employeeExistsInCompany($this->employeeDtoFactory->fromCommand($command))) {
            throw AddEmployeeException::employeeNotFound();
        }
    }
}
