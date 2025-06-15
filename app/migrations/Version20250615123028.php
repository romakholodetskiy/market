<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250615123028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE order_order_item (order_id INT NOT NULL, order_item_id INT NOT NULL, INDEX IDX_E130E25C8D9F6D38 (order_id), INDEX IDX_E130E25CE415FB15 (order_item_id), PRIMARY KEY(order_id, order_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_order_item ADD CONSTRAINT FK_E130E25C8D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_order_item ADD CONSTRAINT FK_E130E25CE415FB15 FOREIGN KEY (order_item_id) REFERENCES order_item (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `order` ADD name VARCHAR(255) NOT NULL, ADD second_name VARCHAR(255) NOT NULL, ADD phone_number VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE order_order_item DROP FOREIGN KEY FK_E130E25C8D9F6D38
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE order_order_item DROP FOREIGN KEY FK_E130E25CE415FB15
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE order_order_item
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE `order` DROP name, DROP second_name, DROP phone_number, DROP address
        SQL);
    }
}
