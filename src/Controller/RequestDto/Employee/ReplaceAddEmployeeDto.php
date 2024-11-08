<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Employee;

use Symfony\Component\Validator\Constraints as Assert;

class ReplaceEmployeeDto extends EmployeeDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'Tax id number is required')]
        #[Assert\Length(min: 10, max: 10, exactMessage: 'Tax id number is invalid.')]
        public string $companyTaxIdNumber,
        #[Assert\NotBlank(message: 'Name is required')]
        public string $name,
        #[Assert\NotBlank(message: 'Surname is required')]
        public string $surname,
        #[Assert\NotBlank(message: 'Email is required')]
        #[Assert\Email]
        public string $email,
        public ?string $phone,
        #[Assert\NotBlank(message: 'Employee id is required')]
        #[Assert\Type('integer')]
        public int $employeeId,
    ) {
        parent::__construct(
            $this->companyTaxIdNumber,
            $this->name,
            $this->surname,
            $this->email,
            $this->phone,
        );
    }
}
