<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907203938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE command_services_detail (command_id INT NOT NULL, services_detail_id INT NOT NULL, INDEX IDX_AAE1100F33E1689A (command_id), INDEX IDX_AAE1100F8F9B8602 (services_detail_id), PRIMARY KEY(command_id, services_detail_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command_services_detail ADD CONSTRAINT FK_AAE1100F33E1689A FOREIGN KEY (command_id) REFERENCES command (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command_services_detail ADD CONSTRAINT FK_AAE1100F8F9B8602 FOREIGN KEY (services_detail_id) REFERENCES services_detail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE command ADD user_id INT NOT NULL, ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_8ECAEAD4A76ED395 ON command (user_id)');
        $this->addSql('CREATE INDEX IDX_8ECAEAD419EB6921 ON command (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE command_services_detail DROP FOREIGN KEY FK_AAE1100F33E1689A');
        $this->addSql('ALTER TABLE command_services_detail DROP FOREIGN KEY FK_AAE1100F8F9B8602');
        $this->addSql('DROP TABLE command_services_detail');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD4A76ED395');
        $this->addSql('ALTER TABLE command DROP FOREIGN KEY FK_8ECAEAD419EB6921');
        $this->addSql('DROP INDEX IDX_8ECAEAD4A76ED395 ON command');
        $this->addSql('DROP INDEX IDX_8ECAEAD419EB6921 ON command');
        $this->addSql('ALTER TABLE command DROP user_id, DROP client_id');
    }
}
