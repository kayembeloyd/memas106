<?php 

include "route.php";

include "controllers/EquipmentsController.php";

include "database/migration.php";

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
        group_length = 5
        exceptions = 1,2,3,4,5 */
        Route::add('/equipments', function() { EquipmentsController::index(); });

        break;
    case 'POST':
        // Adds one equipment to online database
        Route::add('/equipments', function() { EquipmentsController::create(); });

        break;
    case 'PUT':

        // Synchronizes the local and online database
        /* It receives equipments that needs to be updated downwards or upwards */
        Route::add('/equipments', function() { EquipmentsController::update(); });

        // Temporary
        // Creates tables in the online database
        Route::add('/migrate', function() { Migration::runMigration(); });

        break;
    default:
        echo 'unsupported method';
}

//method for execution routes    
Route::submit();