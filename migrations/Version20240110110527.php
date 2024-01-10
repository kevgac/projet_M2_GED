<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110110527 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE access_fds (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, fds_id INT NOT NULL, last_login_date DATETIME DEFAULT NULL, INDEX IDX_1BC6BD709395C3F3 (customer_id), INDEX IDX_1BC6BD70E3578F39 (fds_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD709395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD70E3578F39 FOREIGN KEY (fds_id) REFERENCES fds (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD709395C3F3');
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD70E3578F39');
        $this->addSql('DROP TABLE access_fds');
    }
}
