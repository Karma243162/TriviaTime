<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231113130747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz ADD difficulty_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quiz ADD CONSTRAINT FK_A412FA92FCFA9DAE FOREIGN KEY (difficulty_id) REFERENCES difficulte (id)');
        $this->addSql('CREATE INDEX IDX_A412FA92FCFA9DAE ON quiz (difficulty_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quiz DROP FOREIGN KEY FK_A412FA92FCFA9DAE');
        $this->addSql('DROP INDEX IDX_A412FA92FCFA9DAE ON quiz');
        $this->addSql('ALTER TABLE quiz DROP difficulty_id');
    }
}
