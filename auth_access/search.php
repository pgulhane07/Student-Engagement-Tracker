<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.html');
}

$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 1;
$sql_dept = isset($_SESSION['sql_dept']) ? $_SESSION['sql_dept'] : '';
$sql_search=isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';
if($flag == 0 || $flag == 21 || $flag == 12){
  $flag = 1;
	$_SESSION['flag'] = $flag;
}
$tmp = '';
$print = $_SESSION['print'];

if(!empty($_POST['regid'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['regid']);
  	if($flag==1){
  		  $sql = "SELECT * FROM  authority where UPPER(ID) LIKE UPPER('%$tmp%')";

  	}	
  	elseif($flag==2){
  		  $sql = "SELECT * FROM  authority where UPPER(ID) LIKE UPPER('%$tmp%') AND $sql_dept";
 
      $_SESSION['flag'] = 12;
  	}

  	$_SESSION['sql_search'] = "UPPER(ID) LIKE UPPER('$tmp%')";
    $_SESSION['print'] = $print.' || Reg.ID='.$tmp;
  	$statement = $connection->prepare($sql);
  	if ($statement->execute()) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['people'] = $people;
	 header("location:allocate.php");
	}
	 else{
		echo "ERROR: Could not able to execute $sql.";
	}
}
  elseif(!empty($_POST['Full_Name'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Full_Name']);
  	if($flag==1){
  		  $sql = "SELECT * FROM  authority where UPPER(Full_Name) LIKE UPPER('%$tmp%')";
  	}
  	elseif($flag==2){
  		  $sql = "SELECT * FROM  authority where UPPER(Full_Name)  LIKE UPPER('%$tmp%') AND $sql_dept";

      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(Full_Name) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Full_Name='.$tmp;
  	$statement = $connection->prepare($sql);
  	if ($statement->execute()) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['people'] = $people;
	 header("location:allocate.php");
	}
	 else{
		echo "ERROR: Could not able to execute $sql.";
	}
}






?>