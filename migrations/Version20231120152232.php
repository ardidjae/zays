<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120152232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement ADD souscategorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mouvement ADD CONSTRAINT FK_5B51FC3EA27126E0 FOREIGN KEY (souscategorie_id) REFERENCES sous_categorie (id)');
        $this->addSql('CREATE INDEX IDX_5B51FC3EA27126E0 ON mouvement (souscategorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mouvement DROP FOREIGN KEY FK_5B51FC3EA27126E0');
        $this->addSql('DROP INDEX IDX_5B51FC3EA27126E0 ON mouvement');
        $this->addSql('ALTER TABLE mouvement DROP souscategorie_id');
    }
}
