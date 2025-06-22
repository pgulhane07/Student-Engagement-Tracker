<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 1;
$sql_dept = isset($_SESSION['sql_dept']) ? $_SESSION['sql_dept'] : '';
$sql_search=isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';
if($flag == 0 || $flag == 21 || $flag == 12){
  $flag = 1;
	$_SESSION['flag'] = $flag;
}
$tmp = '';
$Dept = $_SESSION['Dept'];
$print = $_SESSION['print'];

	if(!empty($_POST['regid'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['regid']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT * FROM  authority where UPPER(ID) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
        $sql = "SELECT * FROM  authority where UPPER(ID) LIKE UPPER('%$tmp%') AND Department ='$Dept'";

      }

  	}	
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
  		  $sql = "SELECT * FROM  authority where UPPER(ID) LIKE UPPER('%$tmp%') AND $sql_dept";
        }
      $_SESSION['flag'] = 12;
  	}

  	$_SESSION['sql_search'] = "UPPER(ID) LIKE UPPER('$tmp%')";
    $_SESSION['print'] = $print.' || Reg.ID='.$tmp;
  	$statement = $connection->prepare($sql);
  	if ($statement->execute()) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['people'] = $people;
	 header("location:calculate.php");
	}
	 else{
		echo "ERROR: Could not able to execute $sql.";
	}
}
  elseif(!empty($_POST['Full_Name'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Full_Name']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT * FROM  authority where UPPER(Full_Name) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
        $sql = "SELECT * FROM  authority where UPPER(Full_Name) LIKE UPPER('%$tmp%') AND Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
  		  $sql = "SELECT * FROM  authority where UPPER(Full_Name)  LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(Full_Name) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Full_Name='.$tmp;
  	$statement = $connection->prepare($sql);
  	if ($statement->execute()) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['people'] = $people;
	 header("location:calculate.php");
	}
	 else{
		echo "ERROR: Could not able to execute $sql.";
	}
}
	elseif(!empty($_POST['Class'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Class']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT * FROM  authority where UPPER(Class) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
         $sql = "SELECT * FROM  authority where UPPER(Class) LIKE UPPER('%$tmp%') AND Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
  		  $sql = "SELECT * FROM  authority where UPPER(Class) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(Class) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Class='.$tmp;
  	$statement = $connection->prepare($sql);
  	if ($statement->execute()) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['people'] = $people;
	 header("location:calculate.php");
	}
	 else{
		echo "ERROR: Could not able to execute $sql.";
	}
}
	elseif(!empty($_POST['Email'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Email']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT * FROM authority where UPPER(Email) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
        $sql = "SELECT * FROM  authority where UPPER(Email) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
  		  $sql = "SELECT * FROM  authority where UPPER(Email) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(Email) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Email='.$tmp;
  	$statement = $connection->prepare($sql);
  	if ($statement->execute()) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['people'] = $people;
	 header("location:calculate.php");
	}

	 else{
		echo "ERROR: Could not able to execute $sql.";
	}
}

else{
	echo "Error";
}


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