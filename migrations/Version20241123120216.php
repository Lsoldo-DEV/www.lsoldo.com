<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123120216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service_description ADD service_id INT NOT NULL');
        $this->addSql('ALTER TABLE service_description ADD CONSTRAINT FK_A17E668AED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_A17E668AED5CA9E6 ON service_description (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE service_description DROP CONSTRAINT FK_A17E668AED5CA9E6');
        $this->addSql('DROP INDEX IDX_A17E668AED5CA9E6');
        $this->addSql('ALTER TABLE service_description DROP service_id');
    }
}
