<?php

declare(strict_types=1);

namespace App\ReadModel\Query;

readonly class GetCompanyExmployees extends CompanyQuery
{
    public function __construct(
        private int $companyId,
        int $limit = 10,
        int $offset = 0,
    ) {
        parent::__construct($limit, $offset);
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }
}
