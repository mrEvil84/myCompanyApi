<?php

declare(strict_types=1);

namespace App\Application\Command\Company;

readonly class DeleteCompany
{
    public function __construct(private int $companyId)
    {
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }
}
