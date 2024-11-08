<?php

declare(strict_types=1);

namespace App\Controller\RequestDto;

use App\Application\Command\Company\ReplaceCompany;
use Symfony\Component\Validator\Constraints as Assert;

class ReplaceCompanyDto
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

    public function getCommand(): ReplaceCompany
    {
        return new ReplaceCompany(
            $this->taxIdNumber,
            $this->name,
            $this->address,
            $this->city,
            $this->postalCode
        );
    }
}
