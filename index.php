<?php 

include_once "route.php";

include_once "controllers/EquipmentsController.php";

include_once "database/migration.php";

/**
 * -----------------------------------------------
 * PHP Route Things
 * -----------------------------------------------
 */

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        // Testing route 
        Route::add('/', function(){ echo('home'); });

        // Shows a specific equiment
        Route::add('/equipments/.+', function($id) { EquipmentsController::show($id); });

        // Shows all equipments in groups of 5 by default or specified through group length parameter in the request
        /* Parameters
        page = 1
        group_length = 5
        exceptions = 1,2,3,4,5 */
        Route::add('/equipments', function() { EquipmentsController::index(); });

        break;
    case 'POST':
        // Adds one equipment to online database
        Route::add('/equipments', function() { EquipmentsController::create(); });

        
        // Synchronizes the local and online database
        /* It receives equipments that needs to be updated downwards or upwards 
            it will only return equipments that needs to be updated in the local database
        */
        Route::add('/equipments/update', function() { EquipmentsController::update(); });

        // Temporary
        // Creates tables in the online database
        Route::add('/migrate', function() { Migration::runMigration(); });

        break;
    default:
        echo 'unsupported method';
}

//method for execution routes    
Route::submit();