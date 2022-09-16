<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220915181635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command_materiel (command_id INT NOT NULL, materiel_id INT NOT NULL, INDEX IDX_213E690033E1689A (command_id), INDEX IDX_213E690016880AAF (materiel_id), PRIMARY KEY(command_id, materiel_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command_materiel ADD CONSTRAINT FK_213E690033E1689A FOREIGN KEY (command_id) REFERENCES command (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_materiel ADD CONSTRAINT FK_213E690016880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_materiel DROP FOREIGN KEY FK_213E690033E1689A');
        $this->addSql('ALTER TABLE command_materiel DROP FOREIGN KEY FK_213E690016880AAF');
        $this->addSql('DROP TABLE command_materiel');
    }
}
