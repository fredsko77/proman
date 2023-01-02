<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230102222224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, file_type_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, original_name VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, size VARCHAR(50) NOT NULL, uploaded_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_D8698A769E2A35A8 (file_type_id), INDEX IDX_D8698A76FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, icon VARCHAR(100) DEFAULT NULL, extensions LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invitation_projet (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, sender_id INT DEFAULT NULL, expired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_accepted TINYINT(1) NOT NULL, INDEX IDX_1C104763FB88E14F (utilisateur_id), INDEX IDX_1C104763C18272 (projet_id), INDEX IDX_1C104763F624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre_projet (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, role VARCHAR(255) NOT NULL, is_owner TINYINT(1) NOT NULL, membership_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CA1C0910FB88E14F (utilisateur_id), INDEX IDX_CA1C0910C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, projet_id INT DEFAULT NULL, author_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CFBDFA14C18272 (projet_id), INDEX IDX_CFBDFA14F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, state VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', budget INT DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_projet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, bg_color VARCHAR(35) DEFAULT NULL, ft_color VARCHAR(35) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, reporter_id INT DEFAULT NULL, assignee_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_done TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', level INT NOT NULL, INDEX IDX_527EDB25E1CFE6F5 (reporter_id), INDEX IDX_527EDB2559EC7D60 (assignee_id), INDEX IDX_527EDB25C18272 (projet_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_tag_projet (task_id INT NOT NULL, tag_projet_id INT NOT NULL, INDEX IDX_A5479E2A8DB60186 (task_id), INDEX IDX_A5479E2A11F6B855 (tag_projet_id), PRIMARY KEY(task_id, tag_projet_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, type_id INT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', period VARCHAR(40) DEFAULT NULL, INDEX IDX_723705D17E3C61F9 (owner_id), INDEX IDX_723705D1C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, icon VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_projet (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, icon VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, img_profile VARCHAR(255) DEFAULT NULL, confirm TINYINT(1) DEFAULT NULL, registered_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', username VARCHAR(100) NOT NULL, token VARCHAR(255) DEFAULT NULL, biography LONGTEXT DEFAULT NULL, cover_porfile VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE verification_code (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, expired_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', code VARCHAR(50) NOT NULL, INDEX IDX_E821C39FFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A769E2A35A8 FOREIGN KEY (file_type_id) REFERENCES file_type (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE invitation_projet ADD CONSTRAINT FK_1C104763FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE invitation_projet ADD CONSTRAINT FK_1C104763C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE invitation_projet ADD CONSTRAINT FK_1C104763F624B39D FOREIGN KEY (sender_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE membre_projet ADD CONSTRAINT FK_CA1C0910FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE membre_projet ADD CONSTRAINT FK_CA1C0910C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14F675F31B FOREIGN KEY (author_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25E1CFE6F5 FOREIGN KEY (reporter_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2559EC7D60 FOREIGN KEY (assignee_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE task_tag_projet ADD CONSTRAINT FK_A5479E2A8DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_tag_projet ADD CONSTRAINT FK_A5479E2A11F6B855 FOREIGN KEY (tag_projet_id) REFERENCES tag_projet (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D17E3C61F9 FOREIGN KEY (owner_id) REFERENCES membre_projet (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1C54C8C93 FOREIGN KEY (type_id) REFERENCES transaction_type (id)');
        $this->addSql('ALTER TABLE verification_code ADD CONSTRAINT FK_E821C39FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A769E2A35A8');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76FB88E14F');
        $this->addSql('ALTER TABLE invitation_projet DROP FOREIGN KEY FK_1C104763FB88E14F');
        $this->addSql('ALTER TABLE invitation_projet DROP FOREIGN KEY FK_1C104763C18272');
        $this->addSql('ALTER TABLE invitation_projet DROP FOREIGN KEY FK_1C104763F624B39D');
        $this->addSql('ALTER TABLE membre_projet DROP FOREIGN KEY FK_CA1C0910FB88E14F');
        $this->addSql('ALTER TABLE membre_projet DROP FOREIGN KEY FK_CA1C0910C18272');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14C18272');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14F675F31B');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25E1CFE6F5');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2559EC7D60');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25C18272');
        $this->addSql('ALTER TABLE task_tag_projet DROP FOREIGN KEY FK_A5479E2A8DB60186');
        $this->addSql('ALTER TABLE task_tag_projet DROP FOREIGN KEY FK_A5479E2A11F6B855');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D17E3C61F9');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1C54C8C93');
        $this->addSql('ALTER TABLE verification_code DROP FOREIGN KEY FK_E821C39FFB88E14F');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE file_type');
        $this->addSql('DROP TABLE invitation_projet');
        $this->addSql('DROP TABLE membre_projet');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE tag_projet');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_tag_projet');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE transaction_type');
        $this->addSql('DROP TABLE type_projet');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE verification_code');
    }
}
