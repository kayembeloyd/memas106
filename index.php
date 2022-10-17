<?php 

include "route.php";

include "controllers/EquipmentsController.php";


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
        
        Route::add('/equipments', function() {
            EquipmentsController::index();
        });
        
        Route::add('/equipments/.+/technical_specifications/.+/show', function($id1, $id2) {
            echo ($id1 . '</br>');
            echo ($id2 . '</br>');
            EquipmentsController::showTest();
        });
        
        Route::add('/equipments/.+', function($id) {
            EquipmentsController::show($id);
        });

        break;
    case 'POST':
        Route::add('/equipments', function() {
            EquipmentsController::create();
        });

        break;
    case 'UPDATE':
        // all the UPDATE routes
        break;
    default:
        echo 'unsupported method';
}

//method for execution routes    
Route::submit();