<?php

declare(strict_types=1);

namespace App\Application\Shared;

readonly class EmployeeDto
{
    public function __construct(
        private ?int $companyId,
        private ?int $employeeId,
        private ?string $name,
        private ?string $surname,
        private ?string $email,
        private ?string $phone,
    ) {
    }

    public function getCompanyId(): ?int
    {
        return $this->companyId;
    }

    public function getEmployeeId(): ?int
    {
        return $this->employeeId;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
}
