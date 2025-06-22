<?php
$dsn = 'mysql:host=localhost;dbname=dbms_project';
$username = 'root';
$password = 'root';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {

}

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'dbms_project');
 
/* Attempt to connect to MySQL database */
$link =mysqli_connect("localhost", "root", "root", "dbms_project", 8889);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}