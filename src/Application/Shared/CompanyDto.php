<?php

declare(strict_types=1);

namespace App\Application\Shared;

use App\Application\Command\Company\CompanyCommand;
use App\Application\Command\Company\UpdateCompany;

readonly class CompanyDto
{
    public function __construct(
        private ?string $taxIdNumber,
        private ?string $name,
        private ?string $address,
        private ?string $city,
        private ?string $postalCode,
        private ?int $companyId,
    ) {
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

    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    public static function fromUpdateCommand(UpdateCompany $command): self
    {
        return new self(
            $command->getTaxIdNumber(),
            $command->getName(),
            $command->getAddress(),
            $command->getCity(),
            $command->getPostalCode(),
            $command->getCompanyId(),
        );
    }

    public static function fromCommand(CompanyCommand $command): self
    {
        return new self(
            $command->getTaxIdNumber(),
            $command->getName(),
            $command->getAddress(),
            $command->getCity(),
            $command->getPostalCode(),
            $command->getCompanyId()
        );
    }
}
