<?php 

include_once "database/database.php";

class Migration {

    public static function createEquipmentsTable(){
        $sql_statement = 
        "
            CREATE TABLE `id19693607_memas106`.`equipments` 
            
            (
                `id` INT NOT NULL , 
                `oid` INT NOT NULL AUTO_INCREMENT , 
                `name` INT NOT NULL , 
                `technical_specification` TEXT NOT NULL ,
                PRIMARY KEY (`oid`)
            ) 
                
            ENGINE = InnoDB;
        ";

        Database::execute($sql_statement);
    }

    public static function runMigration(){
        self::createEquipmentsTable();
    }

}