<?php

declare(strict_types=1);

namespace App\DomainModel;

use App\Application\Shared\CompanyDto;
use App\Application\Shared\EmployeeDto;
use App\Entity\Company;

interface CompanyRepository
{
    public function addCompany(Company $company): void;

    public function companyTaxIdNumberExists(string $taxIdNumber): bool;

    public function companyExists(int $companyId): bool;

    public function updateCompany(CompanyDto $companyDto): void;

    public function deleteCompany(int $companyId): void;

    public function addEmployee(EmployeeDto $employeeDto): void;
}
