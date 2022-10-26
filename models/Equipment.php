<?php 

include_once "database/database.php";

class Equipment {
    public static function create($fields){
        $equipment_id = Database::execute_getting_last_id(
                "INSERT INTO id19693607_memas106.equipments (id, name, asset_tag, created_at, updated_at)  
                VALUES (" . $fields['id'] . ",'" . $fields['name'] . "','" . $fields['asset_tag']."','" . $fields['created_at'] . "','" . $fields['updated_at'] . "'"
                . ")" );

        $technical_specification_json = json_decode($fields['technical_specification']);

        $technical_specification_creation_sql_statement = '';
        $technical_specification_creation_results = true;

        foreach ($technical_specification_json as $key => $value) {
            $technical_specification_creation_sql_statement = 
                "INSERT INTO id19693607_memas106.technical_specifications (equipment_id, specification_name, specification_value) 
                VALUES (" . $equipment_id . ",'" . $key . "','" . $value . "'" . 
                ")"
            ;

            $technical_specification_creation_results = $technical_specification_creation_results && Database::execute($technical_specification_creation_sql_statement);
        } 

        return $technical_specification_creation_results;
    }

    public static function all($group_length, $exceptions, $page){
        $exceptions_array = explode(',', $exceptions);
        $exception_statement = '';

        foreach ($exceptions_array as $exception) {
            $exception_statement = $exception_statement . "oid <> $exception AND ";    
        }

        $exception_statement = $exception_statement . "oid <> 0 ";

        /// SELECT * FROM `equipments` WHERE id <> 2 AND id <> 4 AND id <> 8 LIMIT 5 OFFSET 5
        $sqlResults = Database::execute(
            "SELECT * FROM id19693607_memas106.equipments WHERE " . $exception_statement . "LIMIT " . $group_length . " OFFSET " . ($page - 1) * $group_length
        );

        return $sqlResults;
    }

    public static function getTechnicalSpecification($oid){
        return Database::execute("SELECT * FROM id19693607_memas106.technical_specifications WHERE equipment_id = $oid");
    }

    public static function get($id){
        return Database::execute("SELECT * FROM `memas106`.`equipments` WHERE id = $id");
    }
}