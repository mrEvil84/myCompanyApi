<?php

declare(strict_types=1);

namespace App\Controller\RequestDto;

use App\Application\Command\Company\UpdateCompany;
use Symfony\Component\Validator\Constraints as Assert;

readonly class UpdateCompanyDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'Tax id number must be provided.')]
        #[Assert\Length(min: 10, max: 10, exactMessage: 'Tax id number is invalid.')]
        public ?string $taxIdNumber,
        public ?string $name,
        public ?string $address,
        public ?string $city,
        public ?string $postalCode,
    ) {
    }

    public function getCommand(): UpdateCompany
    {
        return new UpdateCompany(
            $this->taxIdNumber,
            $this->name,
            $this->address,
            $this->city,
            $this->postalCode
        );
    }
}
