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
  $columns = array('d.Designation','d.Department','d.TeacherID','authority.Full_Name');
  $column = isset($_SESSION['column']) && in_array($_SESSION['column'], $columns) ? $_SESSION['column'] : $columns[0];
  $sort_order = isset($_SESSION['order']) && strtolower($_SESSION['order']) == 'desc' ? 'DESC' : 'ASC';
  $_SESSION['column'] = $column;
  $_SESSION['order'] = $sort_order;
  }
    
    $sql='SELECT d.Designation,d.Department,d.TeacherID,authority.Full_Name FROM designation_access d INNER JOIN authority  ON d.TeacherID=authority.ID ORDER BY '.$column.' '.$sort_order;
    //
      
    $statement = $connection->prepare($sql);
    if ($statement->execute()) {
        $people = $statement->fetchAll(PDO::FETCH_OBJ);
        $_SESSION['people1'] = $people;
        header("location:access.php");
        //echo $sort_order;
    }else{
      echo $sql;
    }
  
 
?>
