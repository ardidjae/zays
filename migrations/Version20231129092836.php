<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129092836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE immeuble ADD societe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE immeuble ADD CONSTRAINT FK_467D53F9FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_467D53F9FCF77503 ON immeuble (societe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE immeuble DROP FOREIGN KEY FK_467D53F9FCF77503');
        $this->addSql('DROP INDEX IDX_467D53F9FCF77503 ON immeuble');
        $this->addSql('ALTER TABLE immeuble DROP societe_id');
    }
}
