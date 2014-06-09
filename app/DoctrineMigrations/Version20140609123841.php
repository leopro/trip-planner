<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140609123841 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE location (internalIdentity INT AUTO_INCREMENT NOT NULL, name VARCHAR(250) NOT NULL, point_latitude VARCHAR(50) NOT NULL, point_longitude VARCHAR(50) NOT NULL, PRIMARY KEY(internalIdentity)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE route (internalIdentity INT AUTO_INCREMENT NOT NULL, name VARCHAR(250) NOT NULL, PRIMARY KEY(internalIdentity)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE route_legs (link_id INT NOT NULL, report_id INT NOT NULL, INDEX IDX_505D420FADA40271 (link_id), INDEX IDX_505D420F4BD2A4C0 (report_id), PRIMARY KEY(link_id, report_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE leg (internalIdentity INT AUTO_INCREMENT NOT NULL, date_input DATE NOT NULL, date_format VARCHAR(10) NOT NULL, PRIMARY KEY(internalIdentity)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE trip (identity_id VARCHAR(13) NOT NULL, name VARCHAR(250) NOT NULL, PRIMARY KEY(identity_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE trip_routes (link_id VARCHAR(13) NOT NULL, report_id INT NOT NULL, INDEX IDX_DDDA9919ADA40271 (link_id), INDEX IDX_DDDA99194BD2A4C0 (report_id), PRIMARY KEY(link_id, report_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE route_legs ADD CONSTRAINT FK_505D420FADA40271 FOREIGN KEY (link_id) REFERENCES route (internalIdentity)");
        $this->addSql("ALTER TABLE route_legs ADD CONSTRAINT FK_505D420F4BD2A4C0 FOREIGN KEY (report_id) REFERENCES leg (internalIdentity)");
        $this->addSql("ALTER TABLE leg ADD CONSTRAINT FK_75D0804FFFB32BD9 FOREIGN KEY (internalIdentity) REFERENCES location (internalIdentity)");
        $this->addSql("ALTER TABLE trip_routes ADD CONSTRAINT FK_DDDA9919ADA40271 FOREIGN KEY (link_id) REFERENCES trip (identity_id)");
        $this->addSql("ALTER TABLE trip_routes ADD CONSTRAINT FK_DDDA99194BD2A4C0 FOREIGN KEY (report_id) REFERENCES route (internalIdentity)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE leg DROP FOREIGN KEY FK_75D0804FFFB32BD9");
        $this->addSql("ALTER TABLE route_legs DROP FOREIGN KEY FK_505D420FADA40271");
        $this->addSql("ALTER TABLE trip_routes DROP FOREIGN KEY FK_DDDA99194BD2A4C0");
        $this->addSql("ALTER TABLE route_legs DROP FOREIGN KEY FK_505D420F4BD2A4C0");
        $this->addSql("ALTER TABLE trip_routes DROP FOREIGN KEY FK_DDDA9919ADA40271");
        $this->addSql("DROP TABLE location");
        $this->addSql("DROP TABLE route");
        $this->addSql("DROP TABLE route_legs");
        $this->addSql("DROP TABLE leg");
        $this->addSql("DROP TABLE trip");
        $this->addSql("DROP TABLE trip_routes");
    }
}
