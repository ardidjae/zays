<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120143750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bail ADD appartement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bail ADD CONSTRAINT FK_945BC1EE1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id)');
        $this->addSql('CREATE INDEX IDX_945BC1EE1729BBA ON bail (appartement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bail DROP FOREIGN KEY FK_945BC1EE1729BBA');
        $this->addSql('DROP INDEX IDX_945BC1EE1729BBA ON bail');
        $this->addSql('ALTER TABLE bail DROP appartement_id');
    }
}
