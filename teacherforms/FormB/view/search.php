login_auth<?php
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
    	  $sql = 'SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where b.Date_start BETWEEN :DF and :DT';
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where b.Date_start BETWEEN :DF and :DT AND at.Department ='$Dept'";
      }
    }
    elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
    	 $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where b.Date_start BETWEEN :DF and :DT AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
    }
    
    //$sql_search = "s.Date_Sports BETWEEN $df and $dt";
    $_SESSION['sql_search'] = "b.Date_start BETWEEN $df and $dt";
    $_SESSION['print'] = $print.' || Between'.$df.' and '.$dt;
	$statement = $connection->prepare($sql);
	if ($statement->execute([':DF' => $df,':DT' => $dt])) {
		$people = $statement->fetchAll(PDO::FETCH_OBJ);
		$_SESSION['people'] = $people;
	 header("location:calculate.php");
	}
	else{
		echo "ERROR: Could not able to execute $sql.";
	}
}
elseif(!empty($_POST['regid'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['regid']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.ID) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.ID) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";

      }

  	}	
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
  		  $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.ID)  LIKE UPPER('%$tmp%') AND $sql_dept";
        }
      $_SESSION['flag'] = 12;
  	}

  	$_SESSION['sql_search'] = "UPPER(b.ID) LIKE UPPER('$tmp%')";
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
  elseif(!empty($_POST['Activity'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Activity']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Activity) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Activity) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
  		  $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Activity)  LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(b.Activity) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Activity='.$tmp;
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
	elseif(!empty($_POST['Title'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Title']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT b.*,at.Full_Name FROM forma b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Title) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
         $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Title) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
  		  $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Title) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(b.Title) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Title='.$tmp;
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
	elseif(!empty($_POST['Speaker'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Speaker']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Speaker) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Speaker) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
  		  $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Speaker) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(b.Speaker) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Speaker='.$tmp;
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
	

elseif(!empty($_POST['Participants'])){
    $tmp = mysqli_real_escape_string($link, $_REQUEST['Participants']);
    if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Participants) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Participants) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
    }
    elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Participants) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
    }
    
    $_SESSION['sql_search'] = "UPPER(b.Participants) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Participants='.$tmp;
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



elseif(!empty($_POST['Remarks'])){
    $tmp = mysqli_real_escape_string($link, $_REQUEST['Remarks']);
    if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Remarks) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Remarks) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
    }
    elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
        $sql = "SELECT b.*,at.Full_Name FROM formb b INNER JOIN Authority at ON b.ID = at.ID where UPPER(b.Remarks) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
    }
    
    $_SESSION['sql_search'] = "UPPER(b.Remarks) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Remarks='.$tmp;
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
        header("location: ../../../index.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../../../Admin_login.html");
        exit;
    }
    
    
}


?>