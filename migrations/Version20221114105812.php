<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114105812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chat (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, message LONGTEXT DEFAULT NULL, is_report TINYINT(1) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_659DF2AAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comune (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, localisation_postal_code INT DEFAULT NULL, localisation_country VARCHAR(255) DEFAULT NULL, localisation_town_id INT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passage (id INT AUTO_INCREMENT NOT NULL, secteur_id INT DEFAULT NULL, waste_type_id INT DEFAULT NULL, hours LONGTEXT DEFAULT NULL, day_before VARCHAR(255) DEFAULT NULL, INDEX IDX_2B258F679F7E4405 (secteur_id), INDEX IDX_2B258F6721B47B45 (waste_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recycling_center (id INT AUTO_INCREMENT NOT NULL, comune_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, business_hours LONGTEXT DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_4AC94F29885878B0 (comune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE report (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, localisation_name VARCHAR(255) DEFAULT NULL, localisation_number VARCHAR(255) DEFAULT NULL, localisation_longitude VARCHAR(255) DEFAULT NULL, localisation_latitude VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, image LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C42F7784A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, comune_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_8045251F885878B0 (comune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, age INT DEFAULT NULL, img_profile LONGTEXT DEFAULT NULL, is_ban TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE waste (id INT AUTO_INCREMENT NOT NULL, waste_type_id INT DEFAULT NULL, waste_container_model_id INT DEFAULT NULL, commune_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, serial_number VARCHAR(255) DEFAULT NULL, install_first_date DATETIME DEFAULT NULL, install_new_date DATETIME DEFAULT NULL, localisation_name VARCHAR(255) DEFAULT NULL, localisation_street VARCHAR(255) DEFAULT NULL, localisation_latitude DOUBLE PRECISION DEFAULT NULL, localisation_longitude DOUBLE PRECISION DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2E76A48821B47B45 (waste_type_id), INDEX IDX_2E76A4884E480D4F (waste_container_model_id), INDEX IDX_2E76A488131A4F72 (commune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE waste_container_model (id INT AUTO_INCREMENT NOT NULL, model_name VARCHAR(255) DEFAULT NULL, model_manu_facturer VARCHAR(255) DEFAULT NULL, model_useful_capacity INT DEFAULT NULL, model_type VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE waste_type (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) DEFAULT NULL, density DOUBLE PRECISION DEFAULT NULL, customer_designation VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chat ADD CONSTRAINT FK_659DF2AAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE passage ADD CONSTRAINT FK_2B258F679F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('ALTER TABLE passage ADD CONSTRAINT FK_2B258F6721B47B45 FOREIGN KEY (waste_type_id) REFERENCES waste_type (id)');
        $this->addSql('ALTER TABLE recycling_center ADD CONSTRAINT FK_4AC94F29885878B0 FOREIGN KEY (comune_id) REFERENCES comune (id)');
        $this->addSql('ALTER TABLE report ADD CONSTRAINT FK_C42F7784A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE secteur ADD CONSTRAINT FK_8045251F885878B0 FOREIGN KEY (comune_id) REFERENCES comune (id)');
        $this->addSql('ALTER TABLE waste ADD CONSTRAINT FK_2E76A48821B47B45 FOREIGN KEY (waste_type_id) REFERENCES waste_type (id)');
        $this->addSql('ALTER TABLE waste ADD CONSTRAINT FK_2E76A4884E480D4F FOREIGN KEY (waste_container_model_id) REFERENCES waste_container_model (id)');
        $this->addSql('ALTER TABLE waste ADD CONSTRAINT FK_2E76A488131A4F72 FOREIGN KEY (commune_id) REFERENCES comune (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chat DROP FOREIGN KEY FK_659DF2AAA76ED395');
        $this->addSql('ALTER TABLE passage DROP FOREIGN KEY FK_2B258F679F7E4405');
        $this->addSql('ALTER TABLE passage DROP FOREIGN KEY FK_2B258F6721B47B45');
        $this->addSql('ALTER TABLE recycling_center DROP FOREIGN KEY FK_4AC94F29885878B0');
        $this->addSql('ALTER TABLE report DROP FOREIGN KEY FK_C42F7784A76ED395');
        $this->addSql('ALTER TABLE secteur DROP FOREIGN KEY FK_8045251F885878B0');
        $this->addSql('ALTER TABLE waste DROP FOREIGN KEY FK_2E76A48821B47B45');
        $this->addSql('ALTER TABLE waste DROP FOREIGN KEY FK_2E76A4884E480D4F');
        $this->addSql('ALTER TABLE waste DROP FOREIGN KEY FK_2E76A488131A4F72');
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE comune');
        $this->addSql('DROP TABLE passage');
        $this->addSql('DROP TABLE recycling_center');
        $this->addSql('DROP TABLE report');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE waste');
        $this->addSql('DROP TABLE waste_container_model');
        $this->addSql('DROP TABLE waste_type');
    }
}
