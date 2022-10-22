<?php

include "models/Equipment.php";
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
        echo ('creating...');
        
        // echo ($_POST['test']);
    }

    static function update(){
        echo ('updating...');
    }
}