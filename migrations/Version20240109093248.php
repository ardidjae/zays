<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109093248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locataire CHANGE montant_caf montant_caf DOUBLE PRECISION NOT NULL, CHANGE piece_justificative piece_justificative VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bail DROP etat_lieu_entree_signe, DROP etat_lieu_sortie_signe, CHANGE nom_caution1 nom_caution1 VARCHAR(255) DEFAULT NULL, CHANGE nom_caution2 nom_caution2 VARCHAR(255) DEFAULT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL, CHANGE duree_bail duree_bail VARCHAR(255) DEFAULT NULL, CHANGE bail_signe bail_signe VARCHAR(255) DEFAULT NULL, CHANGE etat_lieu_entree etat_lieu_entree VARCHAR(255) DEFAULT NULL, CHANGE etat_lieu_sortie etat_lieu_sortie VARCHAR(255) DEFAULT NULL, CHANGE attestation_assurance attestation_assurance VARCHAR(255) DEFAULT NULL, CHANGE montant_der_echeance montant_der_echeance DOUBLE PRECISION DEFAULT NULL, CHANGE piece_justificative piece_justificative VARCHAR(255) DEFAULT NULL, CHANGE caution_restituer caution_restituer DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire CHANGE montant_caf montant_caf DOUBLE PRECISION DEFAULT NULL, CHANGE piece_justificative piece_justificative VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE piece_jointe ADD bail_id INT DEFAULT NULL, ADD file VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE piece_jointe ADD CONSTRAINT FK_AB5111D43E3F1FE8 FOREIGN KEY (bail_id) REFERENCES bail (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
