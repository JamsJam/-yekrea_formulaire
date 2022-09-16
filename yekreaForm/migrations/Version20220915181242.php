<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220915181242 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services_detail_materiel DROP FOREIGN KEY FK_8F29C31C16880AAF');
        $this->addSql('ALTER TABLE services_detail_materiel DROP FOREIGN KEY FK_8F29C31C8F9B8602');
        $this->addSql('DROP TABLE services_detail_materiel');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE services_detail_materiel (services_detail_id INT NOT NULL, materiel_id INT NOT NULL, INDEX IDX_8F29C31C8F9B8602 (services_detail_id), INDEX IDX_8F29C31C16880AAF (materiel_id), PRIMARY KEY(services_detail_id, materiel_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE services_detail_materiel ADD CONSTRAINT FK_8F29C31C16880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE services_detail_materiel ADD CONSTRAINT FK_8F29C31C8F9B8602 FOREIGN KEY (services_detail_id) REFERENCES services_detail (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
