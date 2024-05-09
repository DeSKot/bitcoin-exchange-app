<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502115547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bitcoin_exchange_rate DROP CONSTRAINT FK_E413948628A69C31');
        $this->addSql('ALTER TABLE bitcoin_exchange_rate ADD CONSTRAINT FK_E413948628A69C31 FOREIGN KEY (currency_id_id) REFERENCES currency (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bitcoin_exchange_rate DROP CONSTRAINT fk_e413948628a69c31');
        $this->addSql('ALTER TABLE bitcoin_exchange_rate ADD CONSTRAINT fk_e413948628a69c31 FOREIGN KEY (currency_id_id) REFERENCES currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
