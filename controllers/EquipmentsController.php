<?php

include_once "models/Equipment.php";
// include "database/database.php";

class EquipmentsController {
    static function index(){

        $group_length = isset($_REQUEST['group_length']) ? $_REQUEST['group_length'] : 5;
        $exceptions = isset($_REQUEST['exceptions']) ? $_REQUEST['exceptions'] : '';
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;

        $equipments = Equipment::all($group_length, $exceptions, $page);

        $equipments_array = array();
        
        while($equipment_object = mysqli_fetch_object($equipments)){
            echo "\n Nice \n";
            echo $equipment_object->oid;
            echo "\n Nice";

            $technical_specifications = Equipment::getTechnicalSpecification($equipment_object->oid) ? Equipment::getTechnicalSpecification($equipment_object->oid) : NULL ;
            $technical_specifications_array = array();
            
            if ($technical_specifications !== NULL){
                while($technical_specification_object = mysqli_fetch_object($technical_specifications)){
                    array_push($technical_specifications_array, $technical_specification_object);
                }
            }

            $equipment_object['technical_specifications'] = $technical_specifications_array;
            array_push($equipmentsArray, $equipment_object);
            
        }

        echo json_encode($equipments_array);
        
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
        $fields['asset_tag'] = isset($_POST['asset_tag']) ? $_POST['asset_tag'] : '';
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