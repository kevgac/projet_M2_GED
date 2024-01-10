<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240110111703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers_products (customers_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_63E6047EC3568B40 (customers_id), INDEX IDX_63E6047E6C8A81A9 (products_id), PRIMARY KEY(customers_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE customers_products ADD CONSTRAINT FK_63E6047EC3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customers_products ADD CONSTRAINT FK_63E6047E6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AC3568B40');
        $this->addSql('DROP INDEX IDX_B3BA5A5AC3568B40 ON products');
        $this->addSql('ALTER TABLE products DROP customers_id, CHANGE unit_price unit_price DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers_products DROP FOREIGN KEY FK_63E6047EC3568B40');
        $this->addSql('ALTER TABLE customers_products DROP FOREIGN KEY FK_63E6047E6C8A81A9');
        $this->addSql('DROP TABLE customers_products');
        $this->addSql('ALTER TABLE products ADD customers_id INT DEFAULT NULL, CHANGE unit_price unit_price INT NOT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AC3568B40 FOREIGN KEY (customers_id) REFERENCES customers (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AC3568B40 ON products (customers_id)');
    }
}
