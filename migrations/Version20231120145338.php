<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120145338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_jointe ADD typejointe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE piece_jointe ADD CONSTRAINT FK_AB5111D470CAF51F FOREIGN KEY (typejointe_id) REFERENCES type_jointe (id)');
        $this->addSql('CREATE INDEX IDX_AB5111D470CAF51F ON piece_jointe (typejointe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_jointe DROP FOREIGN KEY FK_AB5111D470CAF51F');
        $this->addSql('DROP INDEX IDX_AB5111D470CAF51F ON piece_jointe');
        $this->addSql('ALTER TABLE piece_jointe DROP typejointe_id');
    }
}
