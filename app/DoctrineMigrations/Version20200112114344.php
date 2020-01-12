<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200112114344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_527EDB2596901F54 ON task');
        $this->addSql('ALTER TABLE task ADD code VARCHAR(255) NOT NULL, DROP number');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB2577153098 ON task (code)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_527EDB2577153098 ON task');
        $this->addSql('ALTER TABLE task ADD number INT NOT NULL, DROP code');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB2596901F54 ON task (number)');
    }
}
