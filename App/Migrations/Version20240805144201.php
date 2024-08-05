<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240805144201 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF34668989D9B62 ON categories (slug)');
        $this->addSql('ALTER TABLE comments CHANGE content content TEXT NOT NULL');
        $this->addSql('ALTER TABLE posts CHANGE body body LONGTEXT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_885DBAFA989D9B62 ON posts (slug)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FBC9426989D9B62 ON tags (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comments CHANGE content content TEXT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_885DBAFA989D9B62 ON posts');
        $this->addSql('ALTER TABLE posts CHANGE body body LONGTEXT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_6FBC9426989D9B62 ON tags');
        $this->addSql('DROP INDEX UNIQ_3AF34668989D9B62 ON categories');
    }
}
