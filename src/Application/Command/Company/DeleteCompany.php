<?php

declare(strict_types=1);

namespace App\Application\Command;

readonly class DeleteCompany
{
    public function __construct(private string $taxIdNumber)
    {
    }

    public function getTaxIdNumber(): string
    {
        return $this->taxIdNumber;
    }
}
