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

        if ($equipments){
            while($equipment_object = mysqli_fetch_object($equipments)){
                $modified_equipment_object = array();
                $modified_equipment_object['id'] = $equipment_object->id;
                $modified_equipment_object['oid'] = $equipment_object->oid;
                $modified_equipment_object['name'] = $equipment_object->name;
                $modified_equipment_object['asset_tag'] = $equipment_object->asset_tag;
                $modified_equipment_object['created_at'] = $equipment_object->created_at;
                $modified_equipment_object['updated_at'] = $equipment_object->updated_at;

                $technical_specifications = Equipment::getTechnicalSpecification($modified_equipment_object['oid']);
                $technical_specifications_array = array();
                
                if ($technical_specifications){
                    while($technical_specification_object = mysqli_fetch_object($technical_specifications)){
                        array_push($technical_specifications_array, $technical_specification_object);
                    }
                }

                $modified_equipment_object['technical_specifications'] = $technical_specifications_array;
                array_push($equipments_array, $modified_equipment_object);                
            }
        }

        echo json_encode($equipments_array);
    }

    static function show($id){
        $equipment = Equipment::get($id);

        if ($equipment){
            $equipment_object = mysqli_fetch_object($equipment);
            echo json_encode($equipment_object);
        } else {
            echo "404 Resource not found";
        }
    }

    static function create(){
        $fields = array();

        $fields['id'] = isset($_POST['id']) ? $_POST['id'] : 0 ;
        $fields['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $fields['asset_tag'] = isset($_POST['asset_tag']) ? $_POST['asset_tag'] : '';
        $fields['technical_specifications'] = isset($_POST['technical_specifications']) ? $_POST['technical_specifications'] : '';
        $fields['created_at'] = isset($_POST['created_at']) ? $_POST['created_at'] : '2022-10-26 04:27' ;
        $fields['updated_at'] = isset($_POST['updated_at']) ? $_POST['updated_at'] : '2022-10-26 04:27' ;

        $status = Equipment::create($fields);

        $response = array();

        $response['status'] = $status ? 'successfull' : 'failed';
        $response['reason'] = $status ? 'successfully created equipment' : 'ERR1'; 

        echo (json_encode($response));
    }

    static function update(){
        $fields = array();

        $fields['equipments'] = isset($_POST['equipments']) ? $_POST['equipments'] : '';

        $equipments_to_sync = json_decode($fields['equipments']);

        $update_results = array();

        foreach ($equipments_to_sync as $equipment) {
            $update_result = Equipment::update($equipment);
            if ($update_result){
                $update_result_object = mysqli_fetch_object($update_result);
                
                $modified_equipment_object = array();
                $modified_equipment_object['id'] = $equipment->id;
                $modified_equipment_object['oid'] = $update_result_object->oid;
                $modified_equipment_object['name'] = $update_result_object->name;
                $modified_equipment_object['asset_tag'] = $update_result_object->asset_tag;
                $modified_equipment_object['created_at'] = $update_result_object->created_at;
                $modified_equipment_object['updated_at'] = $update_result_object->updated_at;

                array_push($update_results, $modified_equipment_object);
            }
        }

        echo (json_encode($update_results));
    }
}