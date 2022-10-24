<?php 

include_once "database/database.php";

class Equipment {
    public $id = 0;
    public $oid = 0;
    public $name = '';
    public $technicalSpecifications = array();

    public static function create($fields){
        $sqlResults = Database::execute(
                "INSERT INTO id19693607_memas106.equipments 
                    (id, name, technical_specification) 
                VALUES 
                    (" .
                        $fields['id'] . ",'" . $fields['name'] . "','" . $fields['technical_specification']."'"
                    . ")" 
            );

        return $sqlResults;
    }

    public static function all(){
        $sqlResults = Database::execute(
            "SELECT * FROM id19693607_memas106.equipments"
        );

        return $sqlResults;
    }

    public static function get($id){
        return Database::execute("SELECT * FROM `memas106`.`equipments` WHERE id = $id");
    }
}