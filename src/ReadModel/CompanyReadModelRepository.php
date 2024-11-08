<?php

declare(strict_types=1);

namespace App\ReadModel;

interface CompanyReadModelRepository
{
    public function getCompanies(int $limit = 10, int $offset = 0): array;

    public function getCompanyById(int $companyId): array;
}
