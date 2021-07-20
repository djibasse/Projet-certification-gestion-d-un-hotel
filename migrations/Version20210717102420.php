<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210717102420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre ADD administrateur_id INT DEFAULT NULL, ADD categorie_id INT DEFAULT NULL, ADD options_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF7EE5403C FOREIGN KEY (administrateur_id) REFERENCES administrateur (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE chambre ADD CONSTRAINT FK_C509E4FF3ADB05F1 FOREIGN KEY (options_id) REFERENCES `option` (id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF7EE5403C ON chambre (administrateur_id)');
        $this->addSql('CREATE INDEX IDX_C509E4FFBCF5E72D ON chambre (categorie_id)');
        $this->addSql('CREATE INDEX IDX_C509E4FF3ADB05F1 ON chambre (options_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF7EE5403C');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FFBCF5E72D');
        $this->addSql('ALTER TABLE chambre DROP FOREIGN KEY FK_C509E4FF3ADB05F1');
        $this->addSql('DROP INDEX IDX_C509E4FF7EE5403C ON chambre');
        $this->addSql('DROP INDEX IDX_C509E4FFBCF5E72D ON chambre');
        $this->addSql('DROP INDEX IDX_C509E4FF3ADB05F1 ON chambre');
        $this->addSql('ALTER TABLE chambre DROP administrateur_id, DROP categorie_id, DROP options_id');
    }
}
