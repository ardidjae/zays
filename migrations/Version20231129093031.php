<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231129093031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE associe ADD societe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE associe ADD CONSTRAINT FK_235AAA4AFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_235AAA4AFCF77503 ON associe (societe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE associe DROP FOREIGN KEY FK_235AAA4AFCF77503');
        $this->addSql('DROP INDEX IDX_235AAA4AFCF77503 ON associe');
        $this->addSql('ALTER TABLE associe DROP societe_id');
    }
}
