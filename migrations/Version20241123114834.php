<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123114834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE about_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE faq_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reason_to_choose_you_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE service_description_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tarif_plan_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE about (id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, sub_title_message TEXT DEFAULT NULL, body_title VARCHAR(255) DEFAULT NULL, body_sub_title VARCHAR(255) DEFAULT NULL, benefits TEXT DEFAULT NULL, end_page_title VARCHAR(255) DEFAULT NULL, end_page_text TEXT DEFAULT NULL, services_stats JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN about.benefits IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE faq (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE reason_to_choose_you (id INT NOT NULL, service_description_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) NOT NULL, lang VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BDA26546EF9CBDD ON reason_to_choose_you (service_description_id)');
        $this->addSql('CREATE TABLE service (id INT NOT NULL, slug VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE service_description (id INT NOT NULL, lang VARCHAR(255) NOT NULL, published_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, title VARCHAR(255) NOT NULL, summary VARCHAR(255) NOT NULL, content TEXT NOT NULL, top_image VARCHAR(255) DEFAULT NULL, end_image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN service_description.published_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE tarif_plan (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE reason_to_choose_you ADD CONSTRAINT FK_BDA26546EF9CBDD FOREIGN KEY (service_description_id) REFERENCES service_description (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE about_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE faq_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reason_to_choose_you_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE service_description_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tarif_plan_id_seq CASCADE');
        $this->addSql('ALTER TABLE reason_to_choose_you DROP CONSTRAINT FK_BDA26546EF9CBDD');
        $this->addSql('DROP TABLE about');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE reason_to_choose_you');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_description');
        $this->addSql('DROP TABLE tarif_plan');
    }
}
