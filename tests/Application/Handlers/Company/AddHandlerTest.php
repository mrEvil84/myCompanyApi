<?php

declare(strict_types=1);

namespace App\Tests\Application\Handlers\Company;

use App\Application\Command\Company\AddCompany;
use App\Application\Handlers\Company\AddCompanyHandler;
use App\Application\Handlers\Exceptions\CommandHandlerException;
use PHPUnit\Framework\Attributes\Test;

class AddCompanyHandlerTest extends CompanyHandlersBaseTestCase
{
    #[Test]
    public function shouldHandle(): void
    {
        $this
            ->repositoryMock
            ->expects($this->once())
            ->method('companyTaxIdNumberExists')
            ->willReturn(false);

        $sut = new AddCompanyHandler($this->repositoryMock);

        $sut->handle(new AddCompany(
            '123',
            'Company name',
            'Company address',
            'Company city',
            '12-123'
        ));
    }

    #[Test]
    public function shouldNotHandleWhenCompanyNotExists(): void
    {
        $this
            ->repositoryMock
            ->expects($this->once())
            ->method('companyTaxIdNumberExists')
            ->willReturn(true);

        $sut = new AddCompanyHandler($this->repositoryMock);

        $this->expectException(CommandHandlerException::class);
        $this->expectExceptionMessage('Company already exists');

        $sut->handle(new AddCompany(
            '123',
            'Company name',
            'Company address',
            'Company city',
            '12-123'
        ));
    }
}
