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
$sql = '';
$print ='';
$_SESSION['flag'] = 0;

if($flag==0){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		$sql = 'SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID';
		$print ='Paper Presentation :- All Students';
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
		$sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE s.ClassID ='$cid'";
		$print ='Paper Presentation :- '.substr($cid, 0, 3);
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
		$sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
		$print ='Paper Presentation :- '.$dept.' Department';
	}
	
}
elseif($flag==2 ){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		$sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE UPPER(s.Domain) = UPPER('$act')";
		$print ='Paper Presentation:-'.$act;
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
		$sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE UPPER(s.Domain) = UPPER('$act') AND st.Department ='$dept'";
		$print ='Paper Presentation:-'.$act.' '.$dept;
	}
	else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
		$sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE UPPER(s.Domain) = UPPER('$act') AND s.ClassID ='$cid'";
		$print ='Paper Presentation:-'.$act.' '.substr($cid, 0, 3);
	}
	
}
elseif($flag==3 ){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
		$sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE st.Class ='$class'";
		$print ='Paper Presentation:-'.$class.' Class';
	}
}


$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
$_SESSION['people'] = $people; 
$_SESSION['print'] = $print;
header("location:calculate.php");

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
