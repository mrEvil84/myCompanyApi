<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241107095326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create taxIdNumer as unique';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094F9C9EA093 ON company (tax_id_number)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_4FBF094F9C9EA093 ON company');
    }
}
