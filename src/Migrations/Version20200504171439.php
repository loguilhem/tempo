<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504171439 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_527EDB2577153098 ON task');
        $this->addSql('ALTER TABLE time ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT FK_6F949845166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_6F949845166D1F9C ON time (project_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_527EDB2577153098 ON task (code)');
        $this->addSql('ALTER TABLE time DROP FOREIGN KEY FK_6F949845166D1F9C');
        $this->addSql('DROP INDEX IDX_6F949845166D1F9C ON time');
        $this->addSql('ALTER TABLE time DROP project_id');
    }
}
