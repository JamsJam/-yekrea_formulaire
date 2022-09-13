<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220913190846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis ADD command_id INT NOT NULL');
        $this->addSql('ALTER TABLE devis ADD CONSTRAINT FK_8B27C52B33E1689A FOREIGN KEY (command_id) REFERENCES command (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B27C52B33E1689A ON devis (command_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE devis DROP FOREIGN KEY FK_8B27C52B33E1689A');
        $this->addSql('DROP INDEX UNIQ_8B27C52B33E1689A ON devis');
        $this->addSql('ALTER TABLE devis DROP command_id');
    }
}
