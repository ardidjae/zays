<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127154232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bail_locataire (bail_id INT NOT NULL, locataire_id INT NOT NULL, INDEX IDX_EA325C7E3E3F1FE8 (bail_id), INDEX IDX_EA325C7ED8A38199 (locataire_id), PRIMARY KEY(bail_id, locataire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bail_locataire ADD CONSTRAINT FK_EA325C7E3E3F1FE8 FOREIGN KEY (bail_id) REFERENCES bail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bail_locataire ADD CONSTRAINT FK_EA325C7ED8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bail DROP FOREIGN KEY FK_945BC1ED8A38199');
        $this->addSql('DROP INDEX IDX_945BC1ED8A38199 ON bail');
        $this->addSql('ALTER TABLE bail DROP locataire_id, CHANGE bail_signe bail_signe VARCHAR(255) NOT NULL, CHANGE etat_lieu_entree etat_lieu_entree VARCHAR(255) NOT NULL, CHANGE etat_lieu_sortie etat_lieu_sortie VARCHAR(255) NOT NULL, CHANGE attestation_assurance attestation_assurance VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bail_locataire DROP FOREIGN KEY FK_EA325C7E3E3F1FE8');
        $this->addSql('ALTER TABLE bail_locataire DROP FOREIGN KEY FK_EA325C7ED8A38199');
        $this->addSql('DROP TABLE bail_locataire');
        $this->addSql('ALTER TABLE bail ADD locataire_id INT DEFAULT NULL, CHANGE bail_signe bail_signe VARCHAR(255) DEFAULT NULL, CHANGE etat_lieu_entree etat_lieu_entree VARCHAR(255) DEFAULT NULL, CHANGE etat_lieu_sortie etat_lieu_sortie VARCHAR(255) DEFAULT NULL, CHANGE attestation_assurance attestation_assurance VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE bail ADD CONSTRAINT FK_945BC1ED8A38199 FOREIGN KEY (locataire_id) REFERENCES locataire (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_945BC1ED8A38199 ON bail (locataire_id)');
    }
}
