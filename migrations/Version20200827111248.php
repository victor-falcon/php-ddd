<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200827111248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create leads table';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE leads (
            id VARCHAR(36) NOT NULL, 
            name VARCHAR(255) DEFAULT NULL, 
            email VARCHAR(255) NOT NULL, 
            created_at DATETIME NOT NULL, 
            PRIMARY KEY(id)
       ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE leads');
    }
}
