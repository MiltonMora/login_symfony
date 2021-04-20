<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420111050 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course (id VARCHAR(36) NOT NULL, name VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business RENAME INDEX uniq_f1a50c6ee7927c74 TO UNIQ_8D36E38E7927C74');
        $this->addSql('ALTER TABLE business RENAME INDEX uniq_f1a50c6e13dccb41 TO UNIQ_8D36E3813DCCB41');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE course');
        $this->addSql('ALTER TABLE business RENAME INDEX uniq_8d36e3813dccb41 TO UNIQ_F1A50C6E13DCCB41');
        $this->addSql('ALTER TABLE business RENAME INDEX uniq_8d36e38e7927c74 TO UNIQ_F1A50C6EE7927C74');
    }
}
