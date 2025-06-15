<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250615130108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE order_order_item DROP FOREIGN KEY FK_E130E25C8D9F6D38
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_order_item DROP FOREIGN KEY FK_E130E25CE415FB15
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE order_order_item
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE order_order_item (order_id INT NOT NULL, order_item_id INT NOT NULL, INDEX IDX_E130E25CE415FB15 (order_item_id), INDEX IDX_E130E25C8D9F6D38 (order_id), PRIMARY KEY(order_id, order_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_order_item ADD CONSTRAINT FK_E130E25C8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_order_item ADD CONSTRAINT FK_E130E25CE415FB15 FOREIGN KEY (order_item_id) REFERENCES order_item (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
    }
}
