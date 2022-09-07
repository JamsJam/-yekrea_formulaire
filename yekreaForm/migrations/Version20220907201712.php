<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220907201712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services_detail ADD services_id INT NOT NULL');
        $this->addSql('ALTER TABLE services_detail ADD CONSTRAINT FK_B668BD95AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_B668BD95AEF5A6C1 ON services_detail (services_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE services_detail DROP FOREIGN KEY FK_B668BD95AEF5A6C1');
        $this->addSql('DROP INDEX IDX_B668BD95AEF5A6C1 ON services_detail');
        $this->addSql('ALTER TABLE services_detail DROP services_id');
    }
}
