<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210630085811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE in_progress_quest (id INT AUTO_INCREMENT NOT NULL, quest_id INT NOT NULL, user_id INT NOT NULL, count INT DEFAULT NULL, is_accomplished TINYINT(1) NOT NULL, INDEX IDX_687A0C06209E9EF4 (quest_id), INDEX IDX_687A0C06A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE in_progress_quest ADD CONSTRAINT FK_687A0C06209E9EF4 FOREIGN KEY (quest_id) REFERENCES quest (id)');
        $this->addSql('ALTER TABLE in_progress_quest ADD CONSTRAINT FK_687A0C06A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE in_progress_quest');
    }
}
