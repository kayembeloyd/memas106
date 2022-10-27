<?php 

include_once "route.php";

include_once "controllers/EquipmentsController.php";

include_once "database/migration.php";

/**
 * -----------------------------------------------
 * PHP Route Things
 * -----------------------------------------------
 */

function cors() {
    
    // Allow from any origin
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
        // you want to allow, and if so:
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    
    // Access-Control headers are received during OPTIONS requests
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            // may also be using PUT, PATCH, HEAD etc
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    
        exit(0);
    }
}

cors();

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