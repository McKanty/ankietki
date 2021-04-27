<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210427112620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64979BF1BCE');
        $this->addSql('DROP INDEX UNIQ_8D93D64979BF1BCE ON user');
        $this->addSql('ALTER TABLE user CHANGE answers_id answer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649AA334807 ON user (answer_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AA334807');
        $this->addSql('DROP INDEX UNIQ_8D93D649AA334807 ON user');
        $this->addSql('ALTER TABLE user CHANGE answer_id answers_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64979BF1BCE FOREIGN KEY (answers_id) REFERENCES answer (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64979BF1BCE ON user (answers_id)');
    }
}
