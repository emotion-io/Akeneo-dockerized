<?php /** @noinspection ALL */

namespace Pim\Upgrade\Schema;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200225205858 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sessionTableSql = "CREATE TABLE pim_session (
            `sess_id` VARBINARY(128) NOT NULL PRIMARY KEY,
            `sess_data` BLOB NOT NULL,
            `sess_time` INTEGER UNSIGNED NOT NULL,
            `sess_lifetime` MEDIUMINT NOT NULL DEFAULT  '0'
        ) COLLATE utf8mb4_bin, ENGINE = InnoDB;";

        $configTableSql = "CREATE TABLE pim_configuration (
            `code` VARCHAR(128) NOT NULL PRIMARY KEY,
            `values` JSON NOT NULL
        ) COLLATE utf8mb4_unicode_ci, ENGINE = InnoDB;";

        $this->addSql($sessionTableSql);
        $this->addSql($configTableSql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql("DROP TABLE pim_configuration");
        $this->addSql("DROP TABLE pim_session");
    }
}
