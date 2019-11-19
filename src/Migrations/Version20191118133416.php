<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191118133416 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        
        
        $this->addSql('ALTER TABLE option_annonce ADD maison VARCHAR(255) DEFAULT NULL, ADD garage VARCHAR(255) DEFAULT NULL, ADD parking VARCHAR(255) DEFAULT NULL, ADD commerce VARCHAR(255) DEFAULT NULL, CHANGE region appartement VARCHAR(255) NOT NULL');
        
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE annonce ADD filename VARCHAR(255) NOT NULL');
        $this->addSql('CREATE TABLE annonce_option_annonce (annonce_id INT NOT NULL, option_annonce_id INT NOT NULL, INDEX IDX_2B53EB0F8805AB2F (annonce_id), INDEX IDX_2B53EB0F656CB31F (option_annonce_id), PRIMARY KEY(annonce_id, option_annonce_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE annonce_option_annonce ADD CONSTRAINT FK_2B53EB0F8805AB2F FOREIGN KEY (annonce_id) REFERENCES annonce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE annonce_option_annonce ADD CONSTRAINT FK_2B53EB0F656CB31F FOREIGN KEY (option_annonce_id) REFERENCES option_annonce (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE annonce_option_annonce');
        $this->addSql('ALTER TABLE annonce DROP filename, DROP updated_at');
        $this->addSql('ALTER TABLE option_annonce DROP maison, DROP garage, DROP parking, DROP commerce, CHANGE appartement region VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
