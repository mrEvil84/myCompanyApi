<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Employee;

use Symfony\Component\Validator\Constraints as Assert;

class EmployeeDto
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
        #[Assert\Email(message: 'Email is not valid')]
        public string $email,
        public ?string $phone,
    ) {
    }
}
