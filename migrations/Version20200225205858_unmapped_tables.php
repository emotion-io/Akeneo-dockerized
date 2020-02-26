<?php /** @noinspection ALL */

namespace Pim\Upgrade\Schema;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20200225205858_unmapped_tables extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql(
            "CREATE TABLE pim_session (
                `sess_id` VARBINARY(128) NOT NULL PRIMARY KEY,
                `sess_data` BLOB NOT NULL,
                `sess_time` INTEGER UNSIGNED NOT NULL,
                `sess_lifetime` MEDIUMINT NOT NULL DEFAULT  '0'
            ) COLLATE utf8mb4_bin, ENGINE = InnoDB;"
        );
        $this->addSql(
            "CREATE TABLE pim_configuration (
                `code` VARCHAR(128) NOT NULL PRIMARY KEY,
                `values` JSON NOT NULL
            ) COLLATE utf8mb4_unicode_ci, ENGINE = InnoDB;"
        );
        $this->addSql(
            "CREATE TABLE akeneo_structure_version_last_update (
                resource_name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                last_update datetime NOT NULL COMMENT '(DC2Type:datetime)',
                PRIMARY KEY (resource_name)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;"
        );
        $this->addSql(
            "CREATE TABLE pim_aggregated_volume (
                volume_name VARCHAR(255) NOT NULL, 
                volume json NOT NULL COMMENT '(DC2Type:native_json)', 
                aggregated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime)', 
                PRIMARY KEY(volume_name)
            ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB"
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('DROP TABLE pim_aggregated_volume');
        $this->addSql('DROP TABLE akeneo_structure_version_last_update');
        $this->addSql("DROP TABLE pim_configuration");
        $this->addSql("DROP TABLE pim_session");
    }
}
