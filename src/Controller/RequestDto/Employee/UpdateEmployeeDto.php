<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Employee;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateEmployeeDto extends EmployeeDto
{
    public function __construct(
        #[Assert\NotBlank()]
        #[Assert\Length(min: 10, max: 10, exactMessage: 'Tax id number is invalid.')]
        public string $companyTaxIdNumber,
        #[Assert\NotBlank()]
        public string $name,
        #[Assert\NotBlank()]
        public string $surname,
        #[Assert\NotBlank()]
        #[Assert\Email]
        public string $email,
        public ?string $phone,
        #[Assert\NotBlank()]
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
