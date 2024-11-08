<?php

declare(strict_types=1);

namespace App\ReadModel;

use App\ReadModel\Query\GetCompanyExmployees;

readonly class EmployeeReadModel
{
    public function __construct(private EmployeeReadModelRepository $repository)
    {
    }

    public function getCompanyEmployees(GetCompanyExmployees $query): array
    {
        return $this
            ->repository
            ->getCompanyEmployees($query->getCompanyId(), $query->getLimit(), $query->getOffset());
    }

    public function getEmployee(int $employeeId): array
    {
        return $this->repository->getEmployee($employeeId);
    }
}
