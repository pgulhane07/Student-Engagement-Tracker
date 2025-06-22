<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'dbms_project');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect("localhost", "root", "root", "dbms_project", 8889);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

		$usernm="root";
        $passwd="";
        $host="localhost";
        $database="dbms_project";
        $conn = mysqli_connect("localhost", "root", "root", "dbms_project", 8889);

        if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
        }
?>