<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204093124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartement_equipement (appartement_id INT NOT NULL, equipement_id INT NOT NULL, INDEX IDX_EBC624F2E1729BBA (appartement_id), INDEX IDX_EBC624F2806F0F5C (equipement_id), PRIMARY KEY(appartement_id, equipement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appartement_equipement ADD CONSTRAINT FK_EBC624F2E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appartement_equipement ADD CONSTRAINT FK_EBC624F2806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement_equipement DROP FOREIGN KEY FK_EBC624F2E1729BBA');
        $this->addSql('ALTER TABLE appartement_equipement DROP FOREIGN KEY FK_EBC624F2806F0F5C');
        $this->addSql('DROP TABLE appartement_equipement');
    }
}
