<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231009092913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD catid INT AUTO_INCREMENT NOT NULL, DROP id, DROP PRIMARY KEY, ADD PRIMARY KEY (catid)');
        $this->addSql('ALTER TABLE product ADD idcat INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD875B18CF FOREIGN KEY (idcat) REFERENCES category (catid)');
        $this->addSql('CREATE INDEX IDX_D34A04AD875B18CF ON product (idcat)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category MODIFY catid INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON category');
        $this->addSql('ALTER TABLE category ADD id INT NOT NULL, DROP catid');
        $this->addSql('ALTER TABLE category ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD875B18CF');
        $this->addSql('DROP INDEX IDX_D34A04AD875B18CF ON product');
        $this->addSql('ALTER TABLE product DROP idcat');
    }
}
