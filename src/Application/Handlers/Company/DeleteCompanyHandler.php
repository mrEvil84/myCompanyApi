<?php

declare(strict_types=1);

namespace App\Application\Handlers\Company;

use App\Application\Command\Company\DeleteCompany;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use App\DomainModel\CompanyRepository;

final readonly class DeleteCompanyHandler
{
    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    public function handle(DeleteCompany $command): void
    {
        $this->assertCompanyExists($command);
        $this->companyRepository->deleteCompany($command->getCompanyId());
    }

    private function assertCompanyExists(DeleteCompany $command): void
    {
        $taxIdNumberExists = $this->companyRepository->companyExists($command->getCompanyId());
        if (!$taxIdNumberExists) {
            throw CommandHandlerException::companyNotFound();
        }
    }
}
