<?php 



include "route.php";





/**
 * -----------------------------------------------
 * PHP Route Things
 * -----------------------------------------------
 */

//define your route. This is main page route. for example www.example.com
Route::add('/', function(){

    //define which page you want to display while user hit main page. 
    echo('myindex.php');
});


// route for www.example.com/join
Route::add('/join', function(){
    echo('join.php');
});

Route::add('/login', function(){
    echo('login.php');
});

Route::add('/forget', function(){
    echo('forget.php');
});



Route::add('/logout', function(){
    echo('logout.php');
});





//method for execution routes    
Route::submit();