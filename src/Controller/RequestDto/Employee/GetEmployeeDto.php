<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Employee;

use Symfony\Component\Validator\Constraints as Assert;

readonly class GetEmployeeDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'employeeId is required')]
        #[Assert\Type('integer', message: 'employeeId should integer.')]
        #[Assert\Positive(message: 'employeeId should be a positive integer.')]
        public int $employeeId,
    ) {
    }
}
