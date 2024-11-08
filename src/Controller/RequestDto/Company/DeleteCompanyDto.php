<?php

declare(strict_types=1);

namespace App\Controller\RequestDto\Company;

use App\Application\Command\Company\DeleteCompany;
use Symfony\Component\Validator\Constraints as Assert;

readonly class DeleteCompanyDto
{
    public function __construct(
        #[Assert\NotBlank(message: 'Company id is required.')]
        #[Assert\Type('integer', message: 'Company id should be a positive integer.')]
        #[Assert\Positive(message: 'Company should be a positive integer.')]
        public int $companyId,
    ) {
    }

    public function getCommand(): DeleteCompany
    {
        return new DeleteCompany($this->companyId);
    }
}
