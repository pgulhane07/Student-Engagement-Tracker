<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.html');
}

$column = isset($_SESSION['column']) ? $_SESSION['column'] : 'None';
$sort_order = isset($_SESSION['order']) ? $_SESSION['order'] : 'None';
$sql='';

    if($column != 'None' && $sort_order != 'None'){
  $columns = array('access.Class','access.TeacherID','authority.Full_Name');
  $column = isset($_SESSION['column']) && in_array($_SESSION['column'], $columns) ? $_SESSION['column'] : $columns[0];
  $sort_order = isset($_SESSION['order']) && strtolower($_SESSION['order']) == 'desc' ? 'DESC' : 'ASC';
  $_SESSION['column'] = $column;
  $_SESSION['order'] = $sort_order;
  }
    
    $sql='SELECT access.Class,access.TeacherID,authority.Full_Name FROM access INNER JOIN authority  ON access.TeacherID=authority.ID  ORDER BY '.$column.' '.$sort_order;
    //echo $sql;
      
    $statement = $connection->prepare($sql);
    if ($statement->execute()) {
        $people = $statement->fetchAll(PDO::FETCH_OBJ);
        $_SESSION['people1'] = $people;
        header("location:access.php");
        //echo $sort_order;
    }
  
 
?>
