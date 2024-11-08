<?php

declare(strict_types=1);

namespace App\ReadModel;

interface EmployeeReadModelRepository
{
    public function getCompanyEmployees(int $companyId, int $limit = 10, int $offset = 0): array;

    public function getEmployee(int $employeeId): array;
}
