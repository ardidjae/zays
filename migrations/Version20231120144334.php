<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120144334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement ADD moisannee_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1EDBC40344 FOREIGN KEY (moisannee_id) REFERENCES mois_annee (id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1EDBC40344 ON paiement (moisannee_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1EDBC40344');
        $this->addSql('DROP INDEX IDX_B1DC7A1EDBC40344 ON paiement');
        $this->addSql('ALTER TABLE paiement DROP moisannee_id');
    }
}
