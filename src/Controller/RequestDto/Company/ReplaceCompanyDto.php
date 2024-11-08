<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Company;

use Symfony\Component\Validator\Constraints as Assert;

class ReplaceCompanyDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'companyId is required')]
        #[Assert\Type('integer', message: 'companyId should be integer.')]
        #[Assert\Positive(message: 'companyId should be a positive integer.')]
        public int $companyId,
        #[Assert\NotBlank(message: 'taxIdNumber is required.')]
        #[Assert\Length(min: 10, max: 10, exactMessage: 'Tax id number is invalid, exactly 10 characters')]
        public readonly string $taxIdNumber,
        #[Assert\NotBlank(message: 'name is required.')]
        public string $name,
        #[Assert\NotBlank(message: 'address is required.')]
        public string $address,
        #[Assert\NotBlank(message: 'city is required')]
        public string $city,
        #[Assert\NotBlank(message: 'postalCode is required.')]
        public string $postalCode,
    ) {
    }
}
