<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221218232821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE check_list_item (id INT AUTO_INCREMENT NOT NULL, reporter_id INT DEFAULT NULL, project_id INT DEFAULT NULL, is_done TINYINT(1) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F0324837E1CFE6F5 (reporter_id), INDEX IDX_F0324837166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(150) NOT NULL, budget DOUBLE PRECISION DEFAULT NULL, due_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', description LONGTEXT DEFAULT NULL, state VARCHAR(30) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2FB3D0EEB03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_flow (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, member_id INT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_6B511E68166D1F9C (project_id), INDEX IDX_6B511E687597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_member (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, user_id INT DEFAULT NULL, membership_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_owner TINYINT(1) NOT NULL, INDEX IDX_67401132166D1F9C (project_id), INDEX IDX_67401132A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, img_profile VARCHAR(255) DEFAULT NULL, confirm TINYINT(1) DEFAULT NULL, registered_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE check_list_item ADD CONSTRAINT FK_F0324837E1CFE6F5 FOREIGN KEY (reporter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE check_list_item ADD CONSTRAINT FK_F0324837166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project_flow ADD CONSTRAINT FK_6B511E68166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_flow ADD CONSTRAINT FK_6B511E687597D3FE FOREIGN KEY (member_id) REFERENCES project_member (id)');
        $this->addSql('ALTER TABLE project_member ADD CONSTRAINT FK_67401132166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project_member ADD CONSTRAINT FK_67401132A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE check_list_item DROP FOREIGN KEY FK_F0324837E1CFE6F5');
        $this->addSql('ALTER TABLE check_list_item DROP FOREIGN KEY FK_F0324837166D1F9C');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEB03A8386');
        $this->addSql('ALTER TABLE project_flow DROP FOREIGN KEY FK_6B511E68166D1F9C');
        $this->addSql('ALTER TABLE project_flow DROP FOREIGN KEY FK_6B511E687597D3FE');
        $this->addSql('ALTER TABLE project_member DROP FOREIGN KEY FK_67401132166D1F9C');
        $this->addSql('ALTER TABLE project_member DROP FOREIGN KEY FK_67401132A76ED395');
        $this->addSql('DROP TABLE check_list_item');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE project_flow');
        $this->addSql('DROP TABLE project_member');
        $this->addSql('DROP TABLE project_type');
        $this->addSql('DROP TABLE user');
    }
}
