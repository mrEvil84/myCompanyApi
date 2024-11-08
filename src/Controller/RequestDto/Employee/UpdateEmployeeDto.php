<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Employee;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateEmployeeDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'employeeId is required')]
        #[Assert\Type('integer', message: 'employeeId should integer.')]
        #[Assert\Positive(message: 'employeeId should be a positive integer.')]
        public int $employeeId,
        #[Assert\NotBlank(message: 'companyId is required')]
        #[Assert\Type('integer', message: 'companyId should integer.')]
        #[Assert\Positive(message: 'companyId should be a positive integer.')]
        public int $companyId,
        public ?string $name,
        public ?string $surname,
        public ?string $email,
        public ?string $phone,
    ) {
    }
}
