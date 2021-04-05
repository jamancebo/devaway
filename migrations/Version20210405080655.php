<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210405080655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pilots CHANGE id id VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL, CHANGE team team VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE age age INT NOT NULL');
        $this->addSql('ALTER TABLE races DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE races CHANGE id id VARCHAR(255) NOT NULL, CHANGE id_pilot id_pilot VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE best_time best_time VARCHAR(255) NOT NULL, CHANGE points points INT NOT NULL, CHANGE total_time total_time VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE races ADD PRIMARY KEY (id, id_pilot)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pilots CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE photo photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE team team VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE age age INT NOT NULL');
        $this->addSql('ALTER TABLE races DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE races CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id_pilot id_pilot VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE best_time best_time VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE total_time total_time VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE points points INT NOT NULL');
        $this->addSql('ALTER TABLE races ADD PRIMARY KEY (id)');
    }
}
