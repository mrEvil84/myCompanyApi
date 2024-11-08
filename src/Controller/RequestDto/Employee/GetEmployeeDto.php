<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Employee;

use Symfony\Component\Validator\Constraints as Assert;

readonly class GetEmployeeDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'companyId is required')]
        #[Assert\Type('integer', message: 'companyId should integer.')]
        #[Assert\Positive(message: 'companyId should be a positive integer.')]
        public int $companyId,
    ) {
    }
}