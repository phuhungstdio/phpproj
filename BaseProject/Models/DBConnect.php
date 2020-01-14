<?php
class DBConnect{

    static private $conn = null;
    static public function connect()
    {
        $servername = "mysql";
        $username = "root";
        $password = "root";
        // Create connection
        $conn= DBConnect::$conn;
        if(!$conn){
            $conn = new mysqli($servername, $username, $password,"TranPhuHung");
        }
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
?>