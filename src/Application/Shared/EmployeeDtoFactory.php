<?php

declare(strict_types=1);

namespace App\Application\Shared;

use App\Application\Command\Employee\EmployeeCommand;

class EmployeeDtoFactory
{
    public function fromCommand(EmployeeCommand $command): EmployeeDto
    {
        return new EmployeeDto(
            $command->getCompanyId(),
            $command->getEmployeeId(),
            $command->getName(),
            $command->getSurname(),
            $command->getEmail(),
            $command->getPhone(),
        );
    }
}
