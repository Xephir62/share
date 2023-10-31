<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231031091134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE telecharger (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, fichier_id INT DEFAULT NULL, nb INT DEFAULT NULL, INDEX IDX_E06A3C34A76ED395 (user_id), INDEX IDX_E06A3C34F915CFE (fichier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE telecharger ADD CONSTRAINT FK_E06A3C34A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE telecharger ADD CONSTRAINT FK_E06A3C34F915CFE FOREIGN KEY (fichier_id) REFERENCES fichier (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE telecharger DROP FOREIGN KEY FK_E06A3C34A76ED395');
        $this->addSql('ALTER TABLE telecharger DROP FOREIGN KEY FK_E06A3C34F915CFE');
        $this->addSql('DROP TABLE telecharger');
    }
}
