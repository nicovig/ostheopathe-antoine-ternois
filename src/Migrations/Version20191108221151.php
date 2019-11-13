<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191108221151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, session_id INT NOT NULL, location_id INT NOT NULL, date DATETIME NOT NULL, reason VARCHAR(255) DEFAULT NULL, review VARCHAR(255) DEFAULT NULL, real_time TIME DEFAULT NULL, created_at DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_FE38F844613FECDF (session_id), INDEX IDX_FE38F84464D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, sex INT NOT NULL, birthday DATETIME NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, athlete INT DEFAULT NULL, last_appointment DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE practitioner (id INT AUTO_INCREMENT NOT NULL, is_leader TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, appointment_id INT DEFAULT NULL, patient_id INT NOT NULL, practitioner_id INT NOT NULL, title VARCHAR(255) NOT NULL, date DATETIME NOT NULL, validity_period DATETIME NOT NULL, is_valid TINYINT(1) NOT NULL, base64 JSON NOT NULL, UNIQUE INDEX UNIQ_1FBFB8D9E5B533F9 (appointment_id), UNIQUE INDEX UNIQ_1FBFB8D96B899279 (patient_id), INDEX IDX_1FBFB8D91121EA2C (practitioner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rights (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, can_update_appointment TINYINT(1) NOT NULL, can_update_location TINYINT(1) NOT NULL, can_update_patient TINYINT(1) NOT NULL, can_update_practitioner TINYINT(1) NOT NULL, can_update_prescription TINYINT(1) NOT NULL, can_update_secretary TINYINT(1) NOT NULL, can_update_session TINYINT(1) NOT NULL, can_see_location TINYINT(1) NOT NULL, can_see_practitioner TINYINT(1) NOT NULL, can_see_secretary TINYINT(1) NOT NULL, can_see_session TINYINT(1) NOT NULL, can_update_his_appointment TINYINT(1) NOT NULL, can_update_his_patient TINYINT(1) NOT NULL, can_see_his_prescription TINYINT(1) NOT NULL, INDEX IDX_160D103D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, secretary_id INT DEFAULT NULL, practitioner_id INT DEFAULT NULL, patient_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_57698A6AA2A63DB2 (secretary_id), UNIQUE INDEX UNIQ_57698A6A1121EA2C (practitioner_id), UNIQUE INDEX UNIQ_57698A6A6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretary (id INT AUTO_INCREMENT NOT NULL, is_leader TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, average_duration TIME NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84464D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D9E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D96B899279 FOREIGN KEY (patient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D91121EA2C FOREIGN KEY (practitioner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rights ADD CONSTRAINT FK_160D103D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AA2A63DB2 FOREIGN KEY (secretary_id) REFERENCES secretary (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A1121EA2C FOREIGN KEY (practitioner_id) REFERENCES practitioner (id)');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6A6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D9E5B533F9');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84464D218E');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A6B899279');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6A1121EA2C');
        $this->addSql('ALTER TABLE rights DROP FOREIGN KEY FK_160D103D60322AC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AA2A63DB2');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844613FECDF');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D96B899279');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D91121EA2C');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE practitioner');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE rights');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE secretary');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user');
    }
}
