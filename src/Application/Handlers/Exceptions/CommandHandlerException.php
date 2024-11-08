<?php

declare(strict_types=1);

namespace App\Application\Handlers\Exceptions;

use DomainException;

class CommandException extends DomainException
{
    public static function taxIdNumberInvalid(): self
    {
        return new self('Tax id number is invalid');
    }

    public static function companyNotFound(): self
    {
        return new self('Company not found.');
    }

    public static function companyAlreadyExists(): self
    {
        return new self('Company already exists');
    }

    public static function employeeAlreadyExistsInCompany(): self
    {
        return new self('Employee already exists in company.');
    }

    public static function employeeNotFound(): self
    {
        return new self('Employee not exists in company.');
    }
}
