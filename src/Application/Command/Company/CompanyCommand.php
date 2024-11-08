<?php

declare(strict_types=1);

namespace App\Application\Command\Company;

abstract readonly class CompanyCommand
{
    public function __construct(
        private string $taxIdNumber,
        private string $name,
        private string $address,
        private string $city,
        private string $postalCode,
        private ?int $companyId = null,
    ) {
    }

    public function getTaxIdNumber(): string
    {
        return $this->taxIdNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }
}
