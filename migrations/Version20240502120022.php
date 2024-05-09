<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Enum\Currency;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240502120022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        foreach (Currency::getAll() as  $index => $currency) {
            $this->addSql('INSERT INTO currency VALUES ('. ++$index .',\''. $currency .'\')');
        }

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM currency');
    }
}
