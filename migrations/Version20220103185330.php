<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220103185330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expense (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, refunded_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, comment LONGTEXT NOT NULL, created_on DATE NOT NULL, refunded_on DATE DEFAULT NULL, refund_way VARCHAR(255) DEFAULT NULL, total DOUBLE PRECISION NOT NULL, year INT NOT NULL, INDEX IDX_2D3A8DA6F675F31B (author_id), INDEX IDX_2D3A8DA639321F42 (refunded_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA6F675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA639321F42 FOREIGN KEY (refunded_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE expense_line ADD expense_id INT NOT NULL');
        $this->addSql('ALTER TABLE expense_line ADD CONSTRAINT FK_65B3FA94F395DB7B FOREIGN KEY (expense_id) REFERENCES expense (id)');
        $this->addSql('CREATE INDEX IDX_65B3FA94F395DB7B ON expense_line (expense_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE expense_line DROP FOREIGN KEY FK_65B3FA94F395DB7B');
        $this->addSql('DROP TABLE expense');
        $this->addSql('DROP INDEX IDX_65B3FA94F395DB7B ON expense_line');
        $this->addSql('ALTER TABLE expense_line DROP expense_id');
    }
}
