<?php

declare(strict_types=1);

namespace App\Application\Command\Employee;

readonly class EmployeeCommand
{
    public function __construct(
        public int $companyId,
        public ?int $employeeId = null,
        public ?string $name = null,
        public ?string $surname = null,
        public ?string $email = null,
        public ?string $phone = null,
    ) {
    }

    public function getCompanyId(): int
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
