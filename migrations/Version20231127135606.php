<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127135606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement ADD porte INT NOT NULL, ADD surface_sol DOUBLE PRECISION NOT NULL, ADD situation VARCHAR(255) NOT NULL, CHANGE surface surface_habitable DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE associe CHANGE tel tel INT NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE locataire CHANGE archive archive DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement ADD surface DOUBLE PRECISION NOT NULL, DROP porte, DROP surface_habitable, DROP surface_sol, DROP situation');
        $this->addSql('ALTER TABLE associe CHANGE tel tel INT DEFAULT NULL, CHANGE mail mail VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE locataire CHANGE archive archive DOUBLE PRECISION DEFAULT NULL');
    }
}
