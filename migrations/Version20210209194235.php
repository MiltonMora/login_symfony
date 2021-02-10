<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210209194235 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create ´rol´ table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('
            CREATE TABLE `rol` (
                id CHAR(36) NOT NULL PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT U_email UNIQUE KEY (name)
            )
        ');

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE `rol`');
    }
}
