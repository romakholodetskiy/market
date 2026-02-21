<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260221213334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE warehouse_stock (id INT AUTO_INCREMENT NOT NULL, warehouse_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, INDEX IDX_CA572AAD5080ECDE (warehouse_id), INDEX IDX_CA572AAD4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE warehouse_stock ADD CONSTRAINT FK_CA572AAD5080ECDE FOREIGN KEY (warehouse_id) REFERENCES warehouse (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE warehouse_stock ADD CONSTRAINT FK_CA572AAD4584665A FOREIGN KEY (product_id) REFERENCES product (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE warehouse_stock DROP FOREIGN KEY FK_CA572AAD5080ECDE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE warehouse_stock DROP FOREIGN KEY FK_CA572AAD4584665A
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE warehouse_stock
        SQL);
    }
}
