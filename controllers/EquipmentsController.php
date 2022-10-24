<?php

include_once "models/Equipment.php";
// include "database/database.php";

class EquipmentsController {
    static function index(){
        echo ('showing equipments...');

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
        $id = isset($_POST['id']) ? $_POST['id'] : 0 ;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $technicalSpecification = isset($_POST['technical_specification']) ? $_POST['technical_specification'] : '';

        $myResponse = array();

        $myResponse['id'] = $id;
        $myResponse['name'] = $name;
        $myResponse['technical_specification'] = $technicalSpecification;

        echo(json_encode($myResponse));

        // echo ('creating...');
        
        // echo ($_POST['test']);
    }

    static function update(){
        echo ('updating...');
    }
}