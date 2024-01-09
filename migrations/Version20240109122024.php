<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109122024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE piece_jointe DROP bail_id, DROP file');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bail CHANGE etat_lieu_entree_signe etat_lieu_entree_signe VARCHAR(255) DEFAULT NULL, CHANGE etat_lieu_sortie_signe etat_lieu_sortie_signe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE piece_jointe ADD bail_id INT DEFAULT NULL, ADD file VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }
}
