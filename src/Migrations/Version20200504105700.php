<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200504105700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094F5E237E06 ON company (name)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_957A6479979B1AD6 ON fos_user (company_id)');
        $this->addSql('ALTER TABLE project ADD company_id INT NOT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE979B1AD6 ON project (company_id)');
        $this->addSql('ALTER TABLE time DROP FOREIGN KEY FK_6F949845166D1F9C');
        $this->addSql('DROP INDEX IDX_6F949845166D1F9C ON time');
        $this->addSql('ALTER TABLE time ADD end_time DATETIME NOT NULL, DROP project_id, DROP time, CHANGE date start_time DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_4FBF094F5E237E06 ON company');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479979B1AD6');
        $this->addSql('DROP INDEX IDX_957A6479979B1AD6 ON fos_user');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE979B1AD6');
        $this->addSql('DROP INDEX IDX_2FB3D0EE979B1AD6 ON project');
        $this->addSql('ALTER TABLE project DROP company_id, DROP description');
        $this->addSql('ALTER TABLE time ADD project_id INT DEFAULT NULL, ADD date DATETIME NOT NULL, ADD time NUMERIC(10, 0) NOT NULL, DROP start_time, DROP end_time');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT FK_6F949845166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX IDX_6F949845166D1F9C ON time (project_id)');
    }
}
