<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.html');
}

$sql_search = isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 2;
if($flag == 0 || $flag == 21 || $flag == 12){
	$flag = 2;
	$_SESSION['flag'] = $flag;
}
$dept ='';
$print = $_SESSION['print'];

 if(!empty($_POST['dept'])){
		$dept = mysqli_real_escape_string($link,$_REQUEST['dept']);
		$sql="SELECT * FROM  authority WHERE Department ='$dept'";

		$_SESSION['sql_dept'] = " Department ='$dept' ";
		$_SESSION['print'] = $print.' || Department='.$dept;
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