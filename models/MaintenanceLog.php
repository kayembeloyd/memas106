<?php 

include_once "database/database.php";

class MaintenanceLog {
    public static function create($fields){
        $maintenance_log_id = Database::execute_getting_last_id(
            "INSERT INTO id19693607_memas106.maintenance_logs (id, type, equipment_oid, equipment_id, description, created_at, updated_at)  
            VALUES (" . $fields['id'] . ",'" . $fields['type'] . "'," . $fields['equipment_oid'] . "," . $fields['equipment_id'] . ",'" . $fields['description'] . "','" . $fields['created_at'] . "','" . $fields['updated_at'] . "'"
            . ")" );

        return $maintenance_log_id;
    }

    public static function all($group_length, $exceptions, $page){
    }

    public static function get($oid){
    }

    public static function update($equipment){
    }
}