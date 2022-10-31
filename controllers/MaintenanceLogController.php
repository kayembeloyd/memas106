<?php


include_once "models/MaintenanceLog.php";

class MaintenanceLogController {
    static function index(){
    }

    static function show($id){
    }

    static function create(){
        $fields = array();

        $fields['id'] = isset($_POST['id']) ? $_POST['id'] : 0 ;
        $fields['type'] = isset($_POST['type']) ? $_POST['type'] : '';
        $fields['equipment_oid'] = isset($_POST['equipment_oid']) ? $_POST['equipment_oid'] : '';
        $fields['equipment_id'] = isset($_POST['equipment_id']) ? $_POST['equipment_id'] : '';
        $fields['description'] = isset($_POST['description']) ? $_POST['description'] : '';
        $fields['created_at'] = isset($_POST['created_at']) ? $_POST['created_at'] : '2022-10-26 04:27' ;
        $fields['updated_at'] = isset($_POST['updated_at']) ? $_POST['updated_at'] : '2022-10-26 04:27' ;

        $status = MaintenanceLog::create($fields);

        $response = array();

        $response['status'] = $status ? 'successfull' : 'failed';
        $response['reason'] = $status ? 'successfully created maintenance log' : 'ERR1'; 

        echo (json_encode($response));
    }

    static function update(){
    }
}