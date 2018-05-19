<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180519122250 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql("
CREATE TABLE IF NOT EXISTS `access_log` (
  `id` BIGINT(19) UNSIGNED NOT NULL AUTO_INCREMENT,
  `host` VARCHAR(255) NULL DEFAULT NULL,
  `log_name` VARCHAR(255) NULL DEFAULT NULL,
  `user` VARCHAR(255) NULL DEFAULT NULL,
  `time` VARCHAR(255) NULL DEFAULT NULL,
  `request` VARCHAR(1024) NULL DEFAULT NULL,
  `status` TEXT(2048) NULL DEFAULT NULL,
  `response_bytes` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
        ");

    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
