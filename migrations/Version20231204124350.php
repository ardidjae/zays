<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204124350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bail ADD montant_prem_echeance DOUBLE PRECISION NOT NULL, ADD montant_der_echeance DOUBLE PRECISION NOT NULL, ADD trimestre_reference VARCHAR(255) NOT NULL, ADD piece_justificative VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartement_equipement (appartement_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_EBC624F2E1729BBA (appartement_id), INDEX IDX_EBC624F2806F0F5C (equipement_id), PRIMARY KEY(appartement_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, piece_id INT DEFAULT NULL, elements VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, observations VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_B8B4C6F3C40FCFA8 (piece_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE appartement_equipement ADD CONSTRAINT FK_EBC624F2806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_equipement ADD CONSTRAINT FK_EBC624F2E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3C40FCFA8 FOREIGN KEY (piece_id) REFERENCES piece (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE bail DROP montant_prem_echeance, DROP montant_der_echeance, DROP trimestre_reference, DROP piece_justificative');
    }
}
