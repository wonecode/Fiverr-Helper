<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210628184915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE help ADD applicant_id INT NOT NULL');
        $this->addSql('ALTER TABLE help ADD CONSTRAINT FK_8875CAC97139001 FOREIGN KEY (applicant_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8875CAC97139001 ON help (applicant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE help DROP FOREIGN KEY FK_8875CAC97139001');
        $this->addSql('DROP INDEX IDX_8875CAC97139001 ON help');
        $this->addSql('ALTER TABLE help DROP applicant_id');
    }
}
