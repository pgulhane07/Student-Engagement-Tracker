<?php
$dsn = 'mysql:host=localhost;dbname=dbms_project';
$username = 'root';
$password = 'root';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {

}

$usernm="root";
$passwd="";
$host="localhost";
$database="dbms_project";
$conn = mysqli_connect("localhost", "root", "root", "dbms_project", 8889);