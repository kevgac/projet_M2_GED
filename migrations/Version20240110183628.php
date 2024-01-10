<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110183628 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fds ADD products_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fds ADD CONSTRAINT FK_7B86E0A56C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7B86E0A56C8A81A9 ON fds (products_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fds DROP FOREIGN KEY FK_7B86E0A56C8A81A9');
        $this->addSql('DROP INDEX UNIQ_7B86E0A56C8A81A9 ON fds');
        $this->addSql('ALTER TABLE fds DROP products_id');
    }
}
