<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Company;

use App\DomainModel\CompanyRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CompanyHandlersBaseTestCase extends TestCase
{
    protected CompanyRepository|MockObject $repositoryMock;

    protected function setUp(): void
    {
        $this->repositoryMock =  $this
            ->getMockBuilder(CompanyRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
    }
}
