<?php

declare(strict_types=1);

namespace App\ReadModel;

use App\ReadModel\Query\GetCompanies;
use App\ReadModel\Query\GetCompanyExmployees;

readonly class EmployeeReadModel
{
    public function __construct(private CompanyReadModelRepository $repository)
    {
    }

    public function getCompanies(GetCompanies $query): array
    {
        return $this->repository->getCompanies($query->getLimit(), $query->getOffset());
    }

    public function getCompany(string $taxIdNumber): array
    {
        return $this->repository->getCompanyByTaxIdNumber($taxIdNumber);
    }

    public function getCompanyEmployees(GetCompanyExmployees $query): array
    {
        return $this
            ->repository
            ->getCompanyEmployees($query->getCompanyTaxIdNumber(), $query->getLimit(), $query->getOffset());
    }
}
