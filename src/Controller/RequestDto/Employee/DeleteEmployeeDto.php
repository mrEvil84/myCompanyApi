<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Employee;

use Symfony\Component\Validator\Constraints as Assert;

readonly class DeleteEmployeeDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'Employee id is required.')]
        #[Assert\Type('integer', message: 'Employee id should be a positive integer.')]
        #[Assert\Positive(message: 'Employee id should be a positive integer.')]
        public int $employeeId,
    ) {
    }
}
