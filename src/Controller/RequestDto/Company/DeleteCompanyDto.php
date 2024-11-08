<?php

declare(strict_types=1);

namespace App\Controller\RequestDto;

use App\Application\Command\Company\DeleteCompany;
use Symfony\Component\Validator\Constraints as Assert;

readonly class DeleteCompanyDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'Tax id number must be provided.')]
        #[Assert\Length(min: 10, max: 10, exactMessage: 'Tax id number is invalid.')]
        public string $taxIdNumber,
    ) {
    }

    public function getCommand(): DeleteCompany
    {
        return new DeleteCompany($this->taxIdNumber);
    }
}
