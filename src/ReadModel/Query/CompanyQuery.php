<?php

declare(strict_types=1);

namespace App\ReadModel\Query;

readonly abstract class CompanyQuery
{
    public function __construct(private int $limit = 10, private int $offset = 0)
    {
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }
}
