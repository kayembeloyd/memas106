<?php 

class Database {
    public static $servername = "localhost";
    public static $username = "root";
    public static $password = "";

    public static function checkConnection(){
        // Make connection 
        $conn = new mysqli(self::$servername, self::$username, self::$password);
        
        // Check connection
        if ($conn->connect_error) {
            return ($conn->connect_error);
        }

        $conn->close();

        return ('connected');
    }

    public static function execute($sql_statement){
        // Make connection 
        $conn = new mysqli(self::$servername, self::$username, self::$password);
        
        // Check connection
        if ($conn->connect_error) {
            return ($conn->connect_error);
        }

        $results = $conn->query($sql_statement);

        $conn->close();

        return $results;
    }
}