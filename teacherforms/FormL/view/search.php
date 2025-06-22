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
    	  $sql = 'SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where a.Date_start BETWEEN :DF and :DT';
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where a.Date_start BETWEEN :DF and :DT AND at.Department ='$Dept'";
      }
    }
    elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
    	 $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where a.Date_start BETWEEN :DF and :DT AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
    }
    
    //$sql_search = "s.Date_Sports BETWEEN $df and $dt";
    $_SESSION['sql_search'] = "a.Date_start BETWEEN $df and $dt";
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
else
if(!empty($_POST['regid'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['regid']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.ID) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.ID) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";

      }

  	}	
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.ID)  LIKE UPPER('%$tmp%') AND $sql_dept";
        }
      $_SESSION['flag'] = 12;
  	}

  	$_SESSION['sql_search'] = "UPPER(a.ID) LIKE UPPER('$tmp%')";
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
  elseif(!empty($_POST['Name'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Name']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Name) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Name) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Name)  LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(a.Name) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Name='.$tmp;
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
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Title) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
         $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Title) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Title) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(a.Title) LIKE UPPER('%$tmp%')";
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
	elseif(!empty($_POST['Journal'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Journal']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Journal) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Journal) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Journal) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(a.Journal) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Journal='.$tmp;
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
	elseif(!empty($_POST['Level'])){
  	$tmp = mysqli_real_escape_string($link, $_REQUEST['Level']);
  	if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Level) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Level) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
  	}
  	elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
  		  $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Level) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
  	}
  	
  	$_SESSION['sql_search'] = "UPPER(a.Level) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Level='.$tmp;
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

elseif(!empty($_POST['Volume'])){
    $tmp = mysqli_real_escape_string($link, $_REQUEST['Volume']);
    if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Volume) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Volume) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
    }
    elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Volume) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
    }
    
    $_SESSION['sql_search'] = "UPPER(a.Volume) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Volume='.$tmp;
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

elseif(!empty($_POST['Page'])){
    $tmp = mysqli_real_escape_string($link, $_REQUEST['Page']);
    if($flag==1){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Page) LIKE UPPER('%$tmp%')";
      }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Page) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
      }
    }
    elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
        $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Page) LIKE UPPER('%$tmp%') AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
    }
    
    $_SESSION['sql_search'] = "UPPER(a.Page) LIKE UPPER('%$tmp%')";
    $_SESSION['print'] = $print.' || Page='.$tmp;
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

elseif(!empty($_POST['Year'])){
  $tmp = mysqli_real_escape_string($link, $_REQUEST['Year']);
  if($flag==1){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Year) LIKE UPPER('%$tmp%')";
    }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Year) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
    }
  }
  elseif($flag==2){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Year) LIKE UPPER('%$tmp%') AND $sql_dept";
    }
    $_SESSION['flag'] = 12;
  }
  
  $_SESSION['sql_search'] = "UPPER(a.Year) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Year='.$tmp;
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

elseif(!empty($_POST['Isbn'])){
  $tmp = mysqli_real_escape_string($link, $_REQUEST['Isbn']);
  if($flag==1){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Isbn) LIKE UPPER('%$tmp%')";
    }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Isbn) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
    }
  }
  elseif($flag==2){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Isbn) LIKE UPPER('%$tmp%') AND $sql_dept";
    }
    $_SESSION['flag'] = 12;
  }
  
  $_SESSION['sql_search'] = "UPPER(a.Isbn) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Isbn='.$tmp;
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

elseif(!empty($_POST['Publisher'])){
  $tmp = mysqli_real_escape_string($link, $_REQUEST['Publisher']);
  if($flag==1){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Publisher) LIKE UPPER('%$tmp%')";
    }else if($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH']))){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Publisher) LIKE UPPER('%$tmp%') AND at.Department ='$Dept'";
    }
  }
  elseif($flag==2){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD' || isset($_SESSION['CH'])))){
      $sql = "SELECT a.*,at.Full_Name FROM forml a INNER JOIN Authority at ON a.ID = at.ID where UPPER(a.Publisher) LIKE UPPER('%$tmp%') AND $sql_dept";
    }
    $_SESSION['flag'] = 12;
  }
  
  $_SESSION['sql_search'] = "UPPER(a.Publisher) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Publisher='.$tmp;
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