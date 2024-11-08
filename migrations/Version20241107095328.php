<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20241107095328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Seed data';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("
            INSERT INTO my_company_api_dev.company (id, tax_id_number, name, address, city, postal_code) VALUES (1, '9570982826', 'Piotr Kowerzanow inc.', 'Majowa 24', 'Rozyny', '83-031');
            INSERT INTO my_company_api_dev.company (id, tax_id_number, name, address, city, postal_code) VALUES (2, '9570982827', 'Abc inc.', 'Majowa 25', 'Rozyny', '83-031');
            INSERT INTO my_company_api_dev.company (id, tax_id_number, name, address, city, postal_code) VALUES (3, '9570982828', 'Cde inc.', 'Majowa 25', 'Rozyny', '83-031');
            INSERT INTO my_company_api_dev.company (id, tax_id_number, name, address, city, postal_code) VALUES (4, '9570982829', 'Efg inc.', 'Majowa 26', 'Rozyny', '83-031');
        ");

        $this->addSql("
            INSERT INTO my_company_api_dev.employee (id, company_id, name, surname, email, phone) VALUES (1, 2, 'Jan', 'Kowalski', 'jan.kowalski@gmail.com', '567123123');
            INSERT INTO my_company_api_dev.employee (id, company_id, name, surname, email, phone) VALUES (2, 2, 'Jan', 'Kowalski', 'jan.kowalski@gmail.com', '567123123');
            INSERT INTO my_company_api_dev.employee (id, company_id, name, surname, email, phone) VALUES (3, 2, 'Jan', 'Kowalski', 'jan.kowalski@gmail.com', '567123123');
            INSERT INTO my_company_api_dev.employee (id, company_id, name, surname, email, phone) VALUES (4, 2, 'Adam', 'Kowalski', 'adam.kowalski@gmail.com', '567123124');
            INSERT INTO my_company_api_dev.employee (id, company_id, name, surname, email, phone) VALUES (7, 3, 'Kowalski1', 'kamil.kowalski@gmail.com1', '56712312-1', null);
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM my_company_api_dev.company WHERE id IN (1,2,3,4)');
        $this->addSql('DELETE FROM my_company_api_dev.employee WHERE id IN (1,2,3,4,4,7)');
    }
}
