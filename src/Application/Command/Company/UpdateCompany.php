<?php

declare(strict_types=1);

namespace App\Application\Command\Company;

readonly class UpdateCompany
{
    public function __construct(
        private int $companyId,
        private ?string $taxIdNumber = null,
        private ?string $name = null,
        private ?string $address = null,
        private ?string $city = null,
        private ?string $postalCode = null,
    ) {
    }

    public function getCompanyId(): int
    {
        return $this->companyId;
    }

    public function getTaxIdNumber(): ?string
    {
        return $this->taxIdNumber;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }
}
