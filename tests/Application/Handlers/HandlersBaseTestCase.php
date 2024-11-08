<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers;

use App\DomainModel\CompanyRepository;
use App\DomainModel\EmployeeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class HandlersBaseTestCase extends TestCase
{
    protected CompanyRepository|MockObject $companyRepoMock;
    protected EmployeeRepository|MockObject $employeeRepoMock;

    protected function setUp(): void
    {
        $this->companyRepoMock =  $this
            ->getMockBuilder(CompanyRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->employeeRepoMock =  $this
            ->getMockBuilder(EmployeeRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
