<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502114622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bitcoin_exchange_rate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bitcoin_exchange_rate (id INT NOT NULL, currency_id_id INT NOT NULL, exchange_rate VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E413948628A69C31 ON bitcoin_exchange_rate (currency_id_id)');
        $this->addSql('COMMENT ON COLUMN bitcoin_exchange_rate.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE bitcoin_exchange_rate ADD CONSTRAINT FK_E413948628A69C31 FOREIGN KEY (currency_id_id) REFERENCES currency (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bitcoin_exchange_rate_id_seq CASCADE');
        $this->addSql('ALTER TABLE bitcoin_exchange_rate DROP CONSTRAINT FK_E413948628A69C31');
        $this->addSql('DROP TABLE bitcoin_exchange_rate');
    }
}
