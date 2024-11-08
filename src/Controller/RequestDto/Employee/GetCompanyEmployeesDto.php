<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Company;

use Symfony\Component\Validator\Constraints as Assert;

readonly class GetCompanyEmployeesDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'Tax id number must be provided.')]
        #[Assert\Length(min: 10, max: 10, exactMessage: 'Tax id number is invalid.')]
        public string $taxIdNumber,
    ) {
    }
}
