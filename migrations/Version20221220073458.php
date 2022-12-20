<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220073458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE check_list_item ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD completed_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE document ADD member_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A767597D3FE FOREIGN KEY (member_id) REFERENCES project_member (id)');
        $this->addSql('CREATE INDEX IDX_D8698A767597D3FE ON document (member_id)');
        $this->addSql('ALTER TABLE project ADD slug VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE check_list_item DROP created_at, DROP updated_at, DROP completed_at');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A767597D3FE');
        $this->addSql('DROP INDEX IDX_D8698A767597D3FE ON document');
        $this->addSql('ALTER TABLE document DROP member_id');
        $this->addSql('ALTER TABLE project DROP slug');
    }
}
