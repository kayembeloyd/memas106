<?php

include_once "models/Equipment.php";
// include "database/database.php";

class EquipmentsController {
    static function index(){
        $equipments = Equipment::all();

        $equipmentsArray = array();
        
        while($obj = mysqli_fetch_object($equipments)){
            array_push($equipmentsArray, $obj);
        }

        echo json_encode($equipmentsArray);
        
        // $equipments = Equipment::get('all');
    }

    static function show($id){
        echo ('showing an equipment...');
        
        /*
        $equipments = Equipment::get($id);

        while ($obj = mysqli_fetch_object($equipments)) {
            echo '$obj->name = '. $obj->name;
        } */
        // echo 'Database::checkConnection() = ' . Database::checkConnection();
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