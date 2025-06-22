login_auth<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$cid = isset($_SESSION['CID']) ? $_SESSION['CID'] : '';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 1;
$sql_dept = isset($_SESSION['sql_dept']) ? $_SESSION['sql_dept'] : '';
$sql_search=isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';
if($flag == 0 || $flag == 21 || $flag == 12){
	$flag=1;
	$_SESSION['flag']=1;
}
$df = '';
$dt = '';
$tmp = '';
$Dept = $_SESSION['Dept'];
$print = $_SESSION['print'];

	if(!empty($_POST['df']) && !empty($_POST['dt'])){
    $df1 = mysqli_real_escape_string($link, $_REQUEST['df']);
    $df = date('Y-m-d',strtotime($df1)); 
    $dt1 = mysqli_real_escape_string($link, $_REQUEST['dt']);
    $dt = date('Y-m-d',strtotime($dt1));
    if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
    	  $sql = 'SELECT * FROM student where DOB BETWEEN :DF and :DT';
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
        $sql = "SELECT * FROM student where DOB BETWEEN :DF and :DT AND ClassID ='$cid'";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
        $sql = "SELECT * FROM student where DOB BETWEEN :DF and :DT AND Department ='$Dept'";
      }
    }
    elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
    	 $sql = "SELECT * FROM student where DOB BETWEEN :DF and :DT AND $sql_dept";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
        $sql = "SELECT * FROM student where DOB BETWEEN :DF and :DT AND ClassID ='$cid' AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
    }
    
    //$sql_search = "s.Date_Sports BETWEEN $df and $dt";
    $_SESSION['sql_search'] = "DOB BETWEEN $df and $dt";
    $_SESSION['print'] = $print.' || Between'.$df.' and '.$dt;
	$statement = $connection->prepare($sql);
	if ($statement->execute([':DF' => $df,':DT' => $dt])) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
		$_SESSION['people'] = $people;
	 header("location:stu_cal.php");
	}
	else{
		echo "ERROR: Could not able to execute $sql.";
	}
}
elseif(!empty($_POST['regid'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['regid']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT * FROM student where UPPER(ID) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
        $sql = "SELECT * FROM student where UPPER(ID) LIKE UPPER('%$tmp%') AND ClassID ='$cid'";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
        $sql = "SELECT * FROM student where UPPER(ID) LIKE UPPER('%$tmp%') AND Department ='$Dept'";

      }

  	}	
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
  		  $sql = "SELECT * FROM student where UPPER(ID)  LIKE UPPER('%$tmp%') AND $sql_dept";
        }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
          $sql = "SELECT * FROM student where UPPER(ID)  LIKE UPPER('%$tmp%') AND ClassID ='$cid' AND $sql_dept";
        }
      $_SESSION['flag'] = 12;
  	}

  	$_SESSION['sql_search'] = "UPPER(ID) LIKE UPPER('$tmp%')";
    $_SESSION['print'] = $print.' || Reg.ID='.$tmp;
  	$statement = $connection->prepare($sql);
  	if ($statement->execute()) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['people'] = $people;
	 header("location:stu_cal.php");
	}
	 else{
		echo "ERROR: Could not able to execute $sql.";
	}
}
  elseif(!empty($_POST['Full_Name'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Full_Name']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT * FROM student where UPPER(Full_Name) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
        $sql = "SELECT * FROM student where UPPER(Full_Name) LIKE UPPER('%$tmp%') AND ClassID ='$cid'";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
        $sql = "SELECT * FROM student where UPPER(Full_Name) LIKE UPPER('%$tmp%') AND Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
  		  $sql = "SELECT * FROM student where UPPER(Full_Name)  LIKE UPPER('%$tmp%') AND $sql_dept";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
        $sql = "SELECT * FROM student where UPPER(Full_Name)  LIKE UPPER('%$tmp%') AND ClassID ='$cid' AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(Full_Name) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Full Name='.$tmp;
  	$statement = $connection->prepare($sql);
  	if ($statement->execute()) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
    $_SESSION['people'] = $people;
	 header("location:stu_cal.php");
	}
	 else{
		echo "ERROR: Could not able to execute $sql.";
	}
}

elseif(!empty($_POST['Rollno'])){
	$tmp = mysqli_real_escape_string($link, $_REQUEST['Rollno']);
	if($flag==1){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		  $sql = "SELECT * FROM student where UPPER(Rollno) LIKE UPPER('%$tmp%')";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
	  $sql = "SELECT * FROM student where UPPER(Rollno) LIKE UPPER('%$tmp%') AND ClassID ='$cid'";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
	  $sql = "SELECT * FROM student where UPPER(Rollno) LIKE UPPER('%$tmp%') AND Department ='$Dept'";
	}
	}
	elseif($flag==2){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
		  $sql = "SELECT * FROM student where UPPER(Rollno)  LIKE UPPER('%$tmp%') AND $sql_dept";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
	  $sql = "SELECT * FROM student where UPPER(Rollno)  LIKE UPPER('%$tmp%') AND ClassID ='$cid' AND $sql_dept";
	}
	$_SESSION['flag'] = 12;
	}
	
	$_SESSION['sql_search'] = "UPPER(Rollno) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Roll No='.$tmp;
	$statement = $connection->prepare($sql);
	if ($statement->execute()) {
	  $people = $statement->fetchAll(PDO::FETCH_OBJ);
  $_SESSION['people'] = $people;
   header("location:stu_cal.php");
  }
   else{
	  echo "ERROR: Could not able to execute $sql.";
  }
}

elseif(!empty($_POST['Email'])){
	$tmp = mysqli_real_escape_string($link, $_REQUEST['Email']);
	if($flag==1){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		  $sql = "SELECT * FROM student where UPPER(Email) LIKE UPPER('%$tmp%')";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
	  $sql = "SELECT * FROM student where UPPER(Email) LIKE UPPER('%$tmp%') AND ClassID ='$cid'";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
	  $sql = "SELECT * FROM student where UPPER(Email) LIKE UPPER('%$tmp%') AND Department ='$Dept'";
	}
	}
	elseif($flag==2){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
		  $sql = "SELECT * FROM student where UPPER(Email)  LIKE UPPER('%$tmp%') AND $sql_dept";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
	  $sql = "SELECT * FROM student where UPPER(Email)  LIKE UPPER('%$tmp%') AND ClassID ='$cid' AND $sql_dept";
	}
	$_SESSION['flag'] = 12;
	}
	
	$_SESSION['sql_search'] = "UPPER(Email) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Email='.$tmp;
	$statement = $connection->prepare($sql);
	if ($statement->execute()) {
	  $people = $statement->fetchAll(PDO::FETCH_OBJ);
  $_SESSION['people'] = $people;
   header("location:stu_cal.php");
  }
   else{
	  echo "ERROR: Could not able to execute $sql.";
  }
}

elseif(!empty($_POST['Mobile'])){
	$tmp = mysqli_real_escape_string($link, $_REQUEST['Mobile']);
	if($flag==1){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		  $sql = "SELECT * FROM student where UPPER(Mobile) LIKE UPPER('%$tmp%')";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
	  $sql = "SELECT * FROM student where UPPER(Mobile) LIKE UPPER('%$tmp%') AND ClassID ='$cid'";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
	  $sql = "SELECT * FROM student where UPPER(Mobile) LIKE UPPER('%$tmp%') AND Department ='$Dept'";
	}
	}
	elseif($flag==2){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
		  $sql = "SELECT * FROM student where UPPER(Mobile)  LIKE UPPER('%$tmp%') AND $sql_dept";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
	  $sql = "SELECT * FROM student where UPPER(Mobile)  LIKE UPPER('%$tmp%') AND ClassID ='$cid' AND $sql_dept";
	}
	$_SESSION['flag'] = 12;
	}
	
	$_SESSION['sql_search'] = "UPPER(Mobile) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Mobile='.$tmp;
	$statement = $connection->prepare($sql);
	if ($statement->execute()) {
	  $people = $statement->fetchAll(PDO::FETCH_OBJ);
  $_SESSION['people'] = $people;
   header("location:stu_cal.php");
  }
   else{
	  echo "ERROR: Could not able to execute $sql.";
  }
}

elseif(!empty($_POST['DOB'])){
	$tmp = mysqli_real_escape_string($link, $_REQUEST['DOB']);
	if($flag==1){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
		  $sql = "SELECT * FROM student where UPPER(DOB) LIKE UPPER('%$tmp%')";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
	  $sql = "SELECT * FROM student where UPPER(DOB) LIKE UPPER('%$tmp%') AND ClassID ='$cid'";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
	  $sql = "SELECT * FROM student where UPPER(DOB) LIKE UPPER('%$tmp%') AND Department ='$Dept'";
	}
	}
	elseif($flag==2){
	if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
		  $sql = "SELECT * FROM student where UPPER(DOB)  LIKE UPPER('%$tmp%') AND $sql_dept";
	}else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
	  $sql = "SELECT * FROM student where UPPER(DOB)  LIKE UPPER('%$tmp%') AND ClassID ='$cid' AND $sql_dept";
	}
	$_SESSION['flag'] = 12;
	}
	
	$_SESSION['sql_search'] = "UPPER(DOB) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || DOB='.$tmp;
	$statement = $connection->prepare($sql);
	if ($statement->execute()) {
	  $people = $statement->fetchAll(PDO::FETCH_OBJ);
  $_SESSION['people'] = $people;
   header("location:stu_cal.php");
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