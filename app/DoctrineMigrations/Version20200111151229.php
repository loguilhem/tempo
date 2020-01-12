<?php

declare(strict_types=1);

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200111151229 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE temps DROP FOREIGN KEY FK_60B4B720611C0C56');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_938720752C111C7C');
        $this->addSql('ALTER TABLE temps DROP FOREIGN KEY FK_60B4B720D2235D39');
        $this->addSql('CREATE TABLE time (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, user_id INT DEFAULT NULL, task_id INT DEFAULT NULL, date DATETIME NOT NULL, time NUMERIC(10, 0) NOT NULL, INDEX IDX_6F949845166D1F9C (project_id), INDEX IDX_6F949845A76ED395 (user_id), INDEX IDX_6F9498458DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, mother_task_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, UNIQUE INDEX UNIQ_527EDB255E237E06 (name), UNIQUE INDEX UNIQ_527EDB2596901F54 (number), INDEX IDX_527EDB257B035FDD (mother_task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number INT DEFAULT NULL, UNIQUE INDEX UNIQ_2FB3D0EE5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT FK_6F949845166D1F9C FOREIGN KEY (project_id) REFERENCES project (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT FK_6F949845A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE time ADD CONSTRAINT FK_6F9498458DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB257B035FDD FOREIGN KEY (mother_task_id) REFERENCES task (id) ON DELETE SET NULL');
        $this->addSql('DROP TABLE collaborateur');
        $this->addSql('DROP TABLE dossier');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE temps');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE time DROP FOREIGN KEY FK_6F9498458DB60186');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB257B035FDD');
        $this->addSql('ALTER TABLE time DROP FOREIGN KEY FK_6F949845166D1F9C');
        $this->addSql('CREATE TABLE collaborateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dossier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, numero INT DEFAULT NULL, UNIQUE INDEX UNIQ_3D48E0376C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, tachemere_id INT DEFAULT NULL, intitule VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, numero INT NOT NULL, UNIQUE INDEX UNIQ_93872075376925A6 (intitule), INDEX IDX_938720752C111C7C (tachemere_id), UNIQUE INDEX UNIQ_93872075F55AE19E (numero), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE temps (id INT AUTO_INCREMENT NOT NULL, dossier_id INT DEFAULT NULL, collaborateur_id INT DEFAULT NULL, tache_id INT DEFAULT NULL, date DATETIME NOT NULL, exercice INT NOT NULL, tempspasse NUMERIC(9, 2) NOT NULL, INDEX IDX_60B4B720611C0C56 (dossier_id), INDEX IDX_60B4B720D2235D39 (tache_id), INDEX IDX_60B4B720A848E3B1 (collaborateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_938720752C111C7C FOREIGN KEY (tachemere_id) REFERENCES tache (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE temps ADD CONSTRAINT FK_60B4B720611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE temps ADD CONSTRAINT FK_60B4B720A848E3B1 FOREIGN KEY (collaborateur_id) REFERENCES fos_user (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE temps ADD CONSTRAINT FK_60B4B720D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE SET NULL');
        $this->addSql('DROP TABLE time');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE project');
    }
}
