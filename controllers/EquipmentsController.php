<?php

include "models/Equipment.php";
include "database/database.php";

class EquipmentsController {
    static function index(){
        $equipment = Equipment::get();
        $equipment->name = "Equipment 1";
        
        echo ('$equipment->name = ' . $equipment->name);
    }

    static function show($id){
        echo ('Showing equipment ' . $id . '</br>');
        echo 'Database::checkConnection() = ' . Database::checkConnection();
    }

    static function create(){
        echo ($_POST['test']);
    }

    static function showTest(){

    }
}