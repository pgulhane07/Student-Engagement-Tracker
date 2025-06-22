<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
 
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$dept = isset($_GET['Dept']) ? $_GET['Dept'] : $_SESSION['Dept'];
$dsg = isset($_SESSION['Desg']) ? $_SESSION['Desg'] : '';
$sql = '';
$print ='';
$_SESSION['flag']=0;
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		$sql = 'SELECT c.*,at.Full_Name FROM formc c INNER JOIN Authority at ON c.ID = at.ID';
		$print ='FormC:- All Teachers';
	}
	else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
		$sql = "SELECT c.*,at.Full_Name FROM formc c INNER JOIN Authority at ON c.ID = at.ID WHERE at.Department ='$dept'";
		$print ='FormC:- '.$dept.' Department';
	}


$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
$_SESSION['people'] = $people; 
$_SESSION['print'] = $print;
header("location:calculate.php");

}else{
	if($_SESSION['login_flag'] == 2){
        header("location: ../../../index.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../../../Admin_login.html");
        exit;
    }
    
    
}
 ?>
