<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210305132126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Business (id VARCHAR(36) NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, address VARCHAR(100) NOT NULL, idn VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_F1A50C6EE7927C74 (email), UNIQUE INDEX UNIQ_F1A50C6E13DCCB41 (idn), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE business_user (id VARCHAR(36) NOT NULL, business_id VARCHAR(36) NOT NULL, user_id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_DD08D444A89DB457 (business_id), INDEX IDX_DD08D444A76ED395 (user_id), UNIQUE INDEX search_idx (business_id, user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rol (id VARCHAR(36) NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_E553F375E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id VARCHAR(36) NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, status TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_rol (id VARCHAR(36) NOT NULL, rol_id VARCHAR(36) NOT NULL, user_id VARCHAR(36) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E5435EBC4BAB96C (rol_id), INDEX IDX_E5435EBCA76ED395 (user_id), UNIQUE INDEX search_idx (rol_id, user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_user ADD CONSTRAINT FK_DD08D444A89DB457 FOREIGN KEY (business_id) REFERENCES Business (id)');
        $this->addSql('ALTER TABLE business_user ADD CONSTRAINT FK_DD08D444A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_rol ADD CONSTRAINT FK_E5435EBC4BAB96C FOREIGN KEY (rol_id) REFERENCES rol (id)');
        $this->addSql('ALTER TABLE user_rol ADD CONSTRAINT FK_E5435EBCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE business_user DROP FOREIGN KEY FK_DD08D444A89DB457');
        $this->addSql('ALTER TABLE user_rol DROP FOREIGN KEY FK_E5435EBC4BAB96C');
        $this->addSql('ALTER TABLE business_user DROP FOREIGN KEY FK_DD08D444A76ED395');
        $this->addSql('ALTER TABLE user_rol DROP FOREIGN KEY FK_E5435EBCA76ED395');
        $this->addSql('DROP TABLE Business');
        $this->addSql('DROP TABLE business_user');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_rol');
    }
}
