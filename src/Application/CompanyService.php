<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\Command\Company\AddCompany;
use App\Application\Command\Company\DeleteCompany;
use App\Application\Command\Company\ReplaceCompany;
use App\Application\Command\Company\UpdateCompany;
use App\Application\Handlers\Company\AddCompanyHandler;
use App\Application\Handlers\Company\DeleteCompanyHandler;
use App\Application\Handlers\Company\ReplaceCompanyHandler;
use App\Application\Handlers\Company\UpdateCompanyHandler;

readonly class CompanyService
{
    public function __construct(
        private AddCompanyHandler $addHandler,
        private ReplaceCompanyHandler $replaceHandler,
        private UpdateCompanyHandler $updateCompanyHandler,
        private DeleteCompanyHandler $deleteCompanyHandler,
    ) {
    }

    public function addCompany(AddCompany $command): void
    {
        $this->addHandler->handle($command);
    }

    public function replaceCompany(ReplaceCompany $command): void
    {
        $this->replaceHandler->handle($command);
    }

    public function updateCompany(UpdateCompany $command): void
    {
        $this->updateCompanyHandler->handle($command);
    }

    public function deleteCompany(DeleteCompany $command): void
    {
        $this->deleteCompanyHandler->handle($command);
    }
}
