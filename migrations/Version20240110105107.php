<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110105107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fds (id INT AUTO_INCREMENT NOT NULL, product_id_id INT NOT NULL, description VARCHAR(255) NOT NULL, version VARCHAR(255) NOT NULL, pdf_link VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, last_updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_7B86E0A5DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fds ADD CONSTRAINT FK_7B86E0A5DE18E50B FOREIGN KEY (product_id_id) REFERENCES products (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fds DROP FOREIGN KEY FK_7B86E0A5DE18E50B');
        $this->addSql('DROP TABLE fds');
    }
}
