<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110153118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD70E3578F39');
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD709395C3F3');
        $this->addSql('ALTER TABLE customers_products DROP FOREIGN KEY FK_63E6047E6C8A81A9');
        $this->addSql('ALTER TABLE customers_products DROP FOREIGN KEY FK_63E6047EC3568B40');
        $this->addSql('ALTER TABLE fds DROP FOREIGN KEY FK_7B86E0A5DE18E50B');
        $this->addSql('DROP TABLE access_fds');
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE customers_products');
        $this->addSql('DROP TABLE fds');
        $this->addSql('DROP TABLE products');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE access_fds (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, fds_id INT NOT NULL, last_login_date DATETIME DEFAULT NULL, INDEX IDX_1BC6BD70E3578F39 (fds_id), INDEX IDX_1BC6BD709395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE customers (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, registration_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_62534E21E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE customers_products (customers_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_63E6047E6C8A81A9 (products_id), INDEX IDX_63E6047EC3568B40 (customers_id), PRIMARY KEY(customers_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE fds (id INT AUTO_INCREMENT NOT NULL, product_id_id INT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, version VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pdf_link VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, creation_date DATETIME NOT NULL, last_updated DATETIME NOT NULL, UNIQUE INDEX UNIQ_7B86E0A5DE18E50B (product_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, unit_price DOUBLE PRECISION NOT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD70E3578F39 FOREIGN KEY (fds_id) REFERENCES fds (id)');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD709395C3F3 FOREIGN KEY (customer_id) REFERENCES customers (id)');
        $this->addSql('ALTER TABLE customers_products ADD CONSTRAINT FK_63E6047E6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customers_products ADD CONSTRAINT FK_63E6047EC3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fds ADD CONSTRAINT FK_7B86E0A5DE18E50B FOREIGN KEY (product_id_id) REFERENCES products (id)');
    }
}
