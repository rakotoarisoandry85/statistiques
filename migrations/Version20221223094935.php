<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221223094935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
     /*   $this->addSql('ALTER TABLE cisco ADD CONSTRAINT FK_9BF4D0ADBC8BC8C3 FOREIGN KEY (drencisco_id) REFERENCES dren (id)');
        $this->addSql('ALTER TABLE communes ADD CONSTRAINT FK_5C5EE2A5548D767D FOREIGN KEY (ciscom_id) REFERENCES cisco (id)');
        $this->addSql('ALTER TABLE dren CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_F0B590F1B3E9C81 ON effectif');
        $this->addSql('DROP INDEX `primary` ON effectif');
        $this->addSql('ALTER TABLE effectif DROP FOREIGN KEY FK_F0B590F18C09F882');
        $this->addSql('ALTER TABLE effectif ADD PRIMARY KEY (niveau_id)');
        $this->addSql('DROP INDEX csico_id ON effectif');
        $this->addSql('CREATE INDEX IDX_F0B590F18C09F882 ON effectif (cisco_id)');
        $this->addSql('ALTER TABLE effectif ADD CONSTRAINT FK_F0B590F18C09F882 FOREIGN KEY (cisco_id) REFERENCES cisco (id)');*/
        $this->addSql('ALTER TABLE enseignant ADD etabenseignant_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1D4593A2E FOREIGN KEY (foko_enseignant_id) REFERENCES fokontany (id)');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA138A4DA6C FOREIGN KEY (etabenseignant_id) REFERENCES etablissement (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA138A4DA6C ON enseignant (etabenseignant_id)');
        $this->addSql('DROP INDEX foko_enseignant_id ON enseignant');
        $this->addSql('CREATE INDEX IDX_81A72FA1D4593A2E ON enseignant (foko_enseignant_id)');
       /* $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CC1B74EC6 FOREIGN KEY (fokoetab_id) REFERENCES fokontany (id)');
        $this->addSql('ALTER TABLE fokontany CHANGE id id VARCHAR(255) NOT NULL, CHANGE code_fokontany code_fokontany VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE zaps DROP INDEX INDX_8AE06783B6E3837F, ADD UNIQUE INDEX UNIQ_8AE06783B6E3837F (zapcom_id)');*/
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cisco DROP FOREIGN KEY FK_9BF4D0ADBC8BC8C3');
        $this->addSql('ALTER TABLE communes DROP FOREIGN KEY FK_5C5EE2A5548D767D');
        $this->addSql('ALTER TABLE dren CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON effectif');
        $this->addSql('ALTER TABLE effectif DROP FOREIGN KEY FK_F0B590F18C09F882');
        $this->addSql('CREATE INDEX IDX_F0B590F1B3E9C81 ON effectif (niveau_id)');
        $this->addSql('ALTER TABLE effectif ADD PRIMARY KEY (cisco_id, niveau_id)');
        $this->addSql('DROP INDEX idx_f0b590f18c09f882 ON effectif');
        $this->addSql('CREATE INDEX csico_id ON effectif (cisco_id)');
        $this->addSql('ALTER TABLE effectif ADD CONSTRAINT FK_F0B590F18C09F882 FOREIGN KEY (cisco_id) REFERENCES cisco (id)');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1D4593A2E');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA138A4DA6C');
        $this->addSql('DROP INDEX IDX_81A72FA138A4DA6C ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA1D4593A2E');
        $this->addSql('ALTER TABLE enseignant DROP etabenseignant_id');
        $this->addSql('DROP INDEX idx_81a72fa1d4593a2e ON enseignant');
        $this->addSql('CREATE INDEX foko_enseignant_id ON enseignant (foko_enseignant_id)');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA1D4593A2E FOREIGN KEY (foko_enseignant_id) REFERENCES fokontany (id)');
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CC1B74EC6');
        $this->addSql('ALTER TABLE fokontany CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE code_fokontany code_fokontany INT NOT NULL');
        $this->addSql('ALTER TABLE zaps DROP INDEX UNIQ_8AE06783B6E3837F, ADD INDEX INDX_8AE06783B6E3837F (zapcom_id)');
    }
}
