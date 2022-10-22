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
        Route::add('/', function(){
            echo('myindex.php');
        });

        Route::add('/equipments/.+', function($id) {
            EquipmentsController::show($id);
        });

        Route::add('/equipments', function() {
            EquipmentsController::index();
        });

        break;
    case 'POST':
        Route::add('/equipments', function() {
            EquipmentsController::create();
        });

        break;
    case 'PUT':
        // all the UPDATE routes
        Route::add('/migrate', function() {
            echo ("Step 1 </br>");
            Migration::runMigration();
        });

        break;
    default:
        echo 'unsupported method';
}

//method for execution routes    
Route::submit();