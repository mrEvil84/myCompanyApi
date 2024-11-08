<?php

declare(strict_types=1);

namespace App\ReadModel;

use App\ReadModel\Query\GetCompanies;

readonly class CompanyReadModel
{
    public function __construct(private CompanyReadModelRepository $repository)
    {
    }

    public function getCompanies(GetCompanies $query): array
    {
        return $this->repository->getCompanies($query->getLimit(), $query->getOffset());
    }

    public function getCompany(int $companyId): array
    {
        return $this->repository->getCompanyById($companyId);
    }
}
