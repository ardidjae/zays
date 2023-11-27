<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231120144135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement ADD bail_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E3E3F1FE8 FOREIGN KEY (bail_id) REFERENCES bail (id)');
        $this->addSql('CREATE INDEX IDX_B1DC7A1E3E3F1FE8 ON paiement (bail_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E3E3F1FE8');
        $this->addSql('DROP INDEX IDX_B1DC7A1E3E3F1FE8 ON paiement');
        $this->addSql('ALTER TABLE paiement DROP bail_id');
    }
}
