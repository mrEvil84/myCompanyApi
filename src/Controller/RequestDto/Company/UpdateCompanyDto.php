<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Company;

use Symfony\Component\Validator\Constraints as Assert;

readonly class UpdateCompanyDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'companyId is required')]
        #[Assert\Type('integer', message: 'companyId should be integer.')]
        #[Assert\Positive(message: 'companyId should be a positive integer.')]
        public int $companyId,
        public ?string $taxIdNumber,
        public ?string $name,
        public ?string $address,
        public ?string $city,
        public ?string $postalCode,
    ) {
    }
}
