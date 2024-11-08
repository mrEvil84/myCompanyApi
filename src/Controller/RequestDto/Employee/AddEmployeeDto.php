<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Employee;

use Symfony\Component\Validator\Constraints as Assert;

class AddEmployeeDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'companyId is required')]
        #[Assert\Type('integer', message: 'companyId should be integer.')]
        #[Assert\Positive(message: 'companyId should be a positive integer.')]
        public int $companyId,
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
