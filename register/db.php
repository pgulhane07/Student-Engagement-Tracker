<?php
$dsn = 'mysql:host=localhost;dbname=dbms_project';
$username = 'root';
$password = 'root';
$options = [];
try {
$connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e) {
	echo 'DB Error';
}