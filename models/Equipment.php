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

    public static function all($group_length, $exceptions, $page){
        // SAMPLE 
        /// SELECT * FROM `equipments` WHERE id <> 2 AND id <> 4 AND id <> 8 LIMIT 5 OFFSET 5
        $exceptions_array = explode(',', $exceptions);
        $exception_statement = '';

        foreach ($exceptions_array as $exception) {
            $exception_statement = $exception_statement . "id <> $exception AND ";    
        }

        $exception_statement = $exception_statement . "id <> 0 ";

        $sqlResults = Database::execute(
            "SELECT * FROM id19693607_memas106.equipments WHERE " . $exception_statement . "LIMIT " . $group_length . " OFFSET " . ($page - 1) * $group_length
        );

        return $sqlResults;
    }

    public static function get($id){
        return Database::execute("SELECT * FROM `memas106`.`equipments` WHERE id = $id");
    }
}