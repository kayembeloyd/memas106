<?php 

include_once "database/database.php";

class Migration {

    public static function createEquipmentsTable(){
        $sql_statement = 
        "
            CREATE TABLE `id19693607_memas106`.`equipments` ( `id` INT NOT NULL , `oid` INT NOT NULL AUTO_INCREMENT , `name` INT NOT NULL , `technical_specification` TEXT NOT NULL , PRIMARY KEY (`oid`)) ENGINE = InnoDB;

            ALTER TABLE `id19693607_memas106`.`equipments` CHANGE `name` `name` VARCHAR(256) NOT NULL;

            CREATE TABLE `id19693607_memas106`.`technical_specifications` ( `id` INT NOT NULL AUTO_INCREMENT , `equipment_id` INT NOT NULL , `specification_name` VARCHAR(256) NOT NULL , `specification_value` VARCHAR(256) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;
        
            ALTER TABLE `id19693607_memas106`.`equipments` CHANGE `technical_specification` `asset_tag` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;

            ALTER TABLE `equipments` ADD `created_at` TIMESTAMP NOT NULL AFTER `asset_tag`, ADD `updated_at` TIMESTAMP NOT NULL AFTER `created_at`;
        
            ALTER TABLE `equipments` CHANGE `created_at` `created_at` DATETIME NOT NULL;

            ALTER TABLE `equipments` CHANGE `updated_at` `updated_at` DATETIME NOT NULL;
        
        ";

        Database::execute($sql_statement);
    }

    public static function runMigration(){
        self::createEquipmentsTable();
    }

}