<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
 
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$flag = isset($_GET['flag_graph']) ? $_GET['flag_graph'] : 0;
$dept = isset($_GET['Dept']) ? $_GET['Dept'] : $_SESSION['Dept'];
$act = isset($_GET['act']) ? $_GET['act'] : '';
$class = isset($_GET['Class']) ? $_GET['Class'] : '';
$cid = isset($_SESSION['CID']) ? $_SESSION['CID'] : '';
$dsg = isset($_SESSION['Desg']) ? $_SESSION['Desg'] : '';
$rf = isset($_SESSION['rf']) ? $_SESSION['rf'] : '';
$rt = isset($_SESSION['rt']) ? $_SESSION['rt'] : '';
$batch = isset($_SESSION['batch']) ? $_SESSION['batch'] : '';
$sql = '';
$print ='';
$_SESSION['flag'] = 0;

if($flag==0){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		$sql = 'SELECT * FROM student';
		$print ='All Students';
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher' && $_SESSION['mentor'] != true){
		$sql = "SELECT * FROM student WHERE ClassID ='$cid'";
		$print ='All Students:- '.substr($cid, 0, 3);
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher' && $_SESSION['mentor'] == true){
		$sql = "SELECT * FROM  Student WHERE Rollno BETWEEN '$rf' AND '$rt'";
		$print ='All Students:- '.$batch;
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
		$sql = "SELECT * FROM student WHERE Department ='$dept'";
		$print ='All Students:- '.$dept.' Department';
	}
	
}
elseif($flag==1){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		$sql = "SELECT * FROM student WHERE Department ='$dept'";
		$print ='All Students:-'.$dept.' Department';
	}
}
elseif($flag==2 ){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		$sql = "SELECT * FROM student WHERE UPPER(Full_Name) = UPPER('$act')";
		$print ='All Students:-'.$act;
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
		$sql = "SELECT * FROM student WHERE UPPER(Full_Name) = UPPER('$act') AND Department ='$dept'";
		$print ='All Students:-'.$act.' '.$dept;
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
		$sql = "SELECT * FROM student WHERE UPPER(Full_Name) = UPPER('$act') AND ClassID ='$cid'";
		$print ='All Students:-'.$act.' '.substr($cid, 0, 3);
	}
	
}
elseif($flag==3 ){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
		$sql = "SELECT * FROM student WHERE Class ='$class'";
		$print ='All Students:-'.$class.' Class';
	}
}

$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
$_SESSION['people'] = $people; 
$_SESSION['print'] = $print;
header("location:stu_cal.php");

}else{
	if($_SESSION['login_flag'] == 2){
        header("location: ../index.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../Admin_login.html");
        exit;
    }
    
    
}
 ?>

