<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Company;

use Symfony\Component\Validator\Constraints as Assert;

class AddCompanyDto
{
    public function __construct(
        #[Assert\NotBlank()]
        #[Assert\Length(min: 10, max: 10, exactMessage: 'Tax id number is invalid.')]
        public readonly string $taxIdNumber,
        #[Assert\NotBlank()]
        public string $name,
        #[Assert\NotBlank()]
        public string $address,
        #[Assert\NotBlank()]
        public string $city,
        #[Assert\NotBlank()]
        public string $postalCode,
    ) {
    }
}
