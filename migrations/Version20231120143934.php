<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120143934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement ADD immeuble_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8D63768E3F FOREIGN KEY (immeuble_id) REFERENCES immeuble (id)');
        $this->addSql('CREATE INDEX IDX_71A6BD8D63768E3F ON appartement (immeuble_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8D63768E3F');
        $this->addSql('DROP INDEX IDX_71A6BD8D63768E3F ON appartement');
        $this->addSql('ALTER TABLE appartement DROP immeuble_id');
    }
}
