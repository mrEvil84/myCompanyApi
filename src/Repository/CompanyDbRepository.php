<?php

namespace App\Repository;

use App\Application\Command\AddCompany;
use App\DomainModel\CompanyRepository;

class CompanyDbRepository implements CompanyRepository
{

    public function addCompany(AddCompany $addCompany): void
    {
        // TODO: Implement addCompany() method.
    }
}