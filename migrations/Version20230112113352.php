<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230112113352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories ADD COLUMN slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE products ADD COLUMN slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__categories AS SELECT id, parent_id, name FROM categories');
        $this->addSql('DROP TABLE categories');
        $this->addSql('CREATE TABLE categories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, parent_id INTEGER DEFAULT NULL, name VARCHAR(100) NOT NULL, CONSTRAINT FK_3AF34668727ACA70 FOREIGN KEY (parent_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO categories (id, parent_id, name) SELECT id, parent_id, name FROM __temp__categories');
        $this->addSql('DROP TABLE __temp__categories');
        $this->addSql('CREATE INDEX IDX_3AF34668727ACA70 ON categories (parent_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__products AS SELECT id, categories_id, name, description, price, stock, created_at FROM products');
        $this->addSql('DROP TABLE products');
        $this->addSql('CREATE TABLE products (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categories_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL, price INTEGER NOT NULL, stock INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_B3BA5A5AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO products (id, categories_id, name, description, price, stock, created_at) SELECT id, categories_id, name, description, price, stock, created_at FROM __temp__products');
        $this->addSql('DROP TABLE __temp__products');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AA21214B7 ON products (categories_id)');
    }
}
