<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250615125154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_cart_item DROP FOREIGN KEY FK_2A0002B81AD5CDBF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_cart_item DROP FOREIGN KEY FK_2A0002B8E9B59A59
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE cart_cart_item
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE cart_cart_item (cart_id INT NOT NULL, cart_item_id INT NOT NULL, INDEX IDX_2A0002B8E9B59A59 (cart_item_id), INDEX IDX_2A0002B81AD5CDBF (cart_id), PRIMARY KEY(cart_id, cart_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = '' 
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_cart_item ADD CONSTRAINT FK_2A0002B81AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE cart_cart_item ADD CONSTRAINT FK_2A0002B8E9B59A59 FOREIGN KEY (cart_item_id) REFERENCES cart_item (id) ON UPDATE NO ACTION ON DELETE CASCADE
        SQL);
    }
}
