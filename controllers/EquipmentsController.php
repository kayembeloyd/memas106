<?php

include "models/Equipment.php";
// include "database/database.php";

class EquipmentsController {
    static function index(){
        $equipments = Equipment::get('all');
    }

    static function show($id){
        $equipments = Equipment::get($id);

        while ($obj = mysqli_fetch_object($equipments)) {
            echo '$obj->name = '. $obj->name;
        }
        // echo 'Database::checkConnection() = ' . Database::checkConnection();
    }

    static function create(){
        echo ($_POST['test']);
    }

    static function showTest(){

    }
}