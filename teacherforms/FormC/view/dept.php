<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
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
		if($flag == 2 && (($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal'))){
				$sql="SELECT c.*,at.Full_Name FROM formc c INNER JOIN Authority at ON c.ID = at.ID WHERE at.Department ='$dept'";
		}
		elseif($flag == 1 && (($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal'))){
				$sql="SELECT c.*,at.Full_Name FROM formc c INNER JOIN Authority at ON c.ID = at.ID WHERE at.Department ='$dept' AND $sql_search";
			$_SESSION['flag'] = 21;
		}	  
		  $_SESSION['sql_dept'] = " at.Department ='$dept' ";
		  $_SESSION['print'] = $print.' || Department='.$dept;
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