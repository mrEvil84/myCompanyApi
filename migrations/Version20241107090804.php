<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241107090804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update foreign keys';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A138B53C32');
        $this->addSql('DROP INDEX IDX_5D9F75A138B53C32 ON employee');
        $this->addSql('ALTER TABLE employee CHANGE company_id_id company_id INT NOT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_5D9F75A1979B1AD6 ON employee (company_id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1979B1AD6');
        $this->addSql('DROP INDEX IDX_5D9F75A1979B1AD6 ON employee');
        $this->addSql('ALTER TABLE employee CHANGE company_id company_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A138B53C32 FOREIGN KEY (company_id_id) REFERENCES company (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5D9F75A138B53C32 ON employee (company_id_id)');
    }
}
