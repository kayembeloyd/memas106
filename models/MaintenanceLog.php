<?php 

include_once "database/database.php";

class MaintenanceLog {
    public static function create($fields){
        echo "SQL Statement = \n";
        echo 
        ("INSERT INTO id19693607_memas106.maintenance_logs (id, type, equipment_oid, equipment_id, description, created_at, updated_at)  
        VALUES (" . $fields['id'] . ",'" . $fields['type'] . "'," . $fields['equipment_oid'] . "," . $fields['equipment_id'] . ",'" . $fields['description'] . "','" . $fields['created_at'] . "','" . $fields['updated_at'] . "'"
        . ")");
        echo "\n";

        $maintenance_log_id = Database::execute_getting_last_id(
            "INSERT INTO id19693607_memas106.maintenance_logs (id, type, equipment_oid, equipment_id, description, created_at, updated_at)  
            VALUES (" . $fields['id'] . ",'" . $fields['type'] . "'," . $fields['equipment_oid'] . "," . $fields['equipment_id'] . ",'" . $fields['description'] . "','" . $fields['created_at'] . "','" . $fields['updated_at'] . "'"
            . ")" );

        return $maintenance_log_id;
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
            "SELECT * FROM id19693607_memas106.maintenance_logs WHERE " . $exception_statement . "LIMIT " . $group_length . " OFFSET " . ($page - 1) * $group_length
        );

        return $sqlResults;
    }

    public static function get($oid){
    }

    public static function update($equipment){
    }
}