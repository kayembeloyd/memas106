<?php

include_once "models/Equipment.php";
// include "database/database.php";

class EquipmentsController {
    static function index(){

        $group_length = isset($_REQUEST['group_length']) ? $_REQUEST['group_length'] : 5;
        $exceptions = isset($_REQUEST['exceptions']) ? $_REQUEST['exceptions'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

        $equipments = Equipment::all($group_length, $exceptions, $page);

        $equipmentsArray = array();
        
        while($obj = mysqli_fetch_object($equipments)){
            array_push($equipmentsArray, $obj);
        }

        echo json_encode($equipmentsArray);
        
        // $equipments = Equipment::get('all');
    }

    static function show($id){
        echo ('showing an equipment...');
    }

    static function create(){
        // Get info 
        $fields = array();

        $fields['id'] = isset($_POST['id']) ? $_POST['id'] : 0 ;
        $fields['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $fields['technical_specification'] = isset($_POST['technical_specification']) ? $_POST['technical_specification'] : '';

        $status = Equipment::create($fields);

        $response = array();

        $response['status'] = $status ? 'successfull' : 'failed';
        $response['reason'] = $status ? 'successfully created equipment' : 'ERR1'; 

        echo (json_encode($response));
    }

    static function update(){
        echo ('updating...');
    }
}