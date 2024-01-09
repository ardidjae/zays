<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109125355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categorie ADD bail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sous_categorie ADD CONSTRAINT FK_52743D7B3E3F1FE8 FOREIGN KEY (bail_id) REFERENCES bail (id)');
        $this->addSql('CREATE INDEX IDX_52743D7B3E3F1FE8 ON sous_categorie (bail_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bail CHANGE etat_lieu_entree_signe etat_lieu_entree_signe VARCHAR(255) DEFAULT NULL, CHANGE etat_lieu_sortie_signe etat_lieu_sortie_signe VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE piece_jointe ADD bail_id INT DEFAULT NULL, ADD file VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sous_categorie DROP FOREIGN KEY FK_52743D7B3E3F1FE8');
        $this->addSql('DROP INDEX IDX_52743D7B3E3F1FE8 ON sous_categorie');
        $this->addSql('ALTER TABLE sous_categorie DROP bail_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }
}
