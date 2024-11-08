<?php

declare(strict_types=1);

namespace App\ReadModel;

interface EmployeeReadModelRepository
{
    public function getCompanies(int $limit = 10, int $offset = 0): array;

    public function getCompanyByTaxIdNumber(string $taxIdNumber): array;

    public function getCompanyEmployees(string $taxIdNumber, int $limit = 10, int $offset = 0): array;
}
