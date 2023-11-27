<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120144911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_jointe ADD locataire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE piece_jointe ADD CONSTRAINT FK_AB5111D4D8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id)');
        $this->addSql('CREATE INDEX IDX_AB5111D4D8A38199 ON piece_jointe (locataire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_jointe DROP FOREIGN KEY FK_AB5111D4D8A38199');
        $this->addSql('DROP INDEX IDX_AB5111D4D8A38199 ON piece_jointe');
        $this->addSql('ALTER TABLE piece_jointe DROP locataire_id');
    }
}
