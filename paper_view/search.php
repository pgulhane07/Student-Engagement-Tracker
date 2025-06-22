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
	$_SESSION['flag']=$flag;
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
    	  $sql = 'SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where s.Date_publish BETWEEN :DF and :DT';
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
        $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where s.Date_publish BETWEEN :DF and :DT AND s.ClassID ='$cid'";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
        $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where s.Date_publish BETWEEN :DF and :DT AND st.Department ='$Dept'";
      }
    }
    elseif($flag==2){
      if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
    	 $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where s.Date_publish BETWEEN :DF and :DT AND $sql_dept";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
        $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where s.Date_publish BETWEEN :DF and :DT AND s.ClassID ='$cid' AND $sql_dept";
      }
      $_SESSION['flag'] = 12;
    }
    $_SESSION['sql_search'] = "s.Date_publish BETWEEN $df and $dt";
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
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.ID) LIKE UPPER('%$tmp%')";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.ID) LIKE UPPER('%$tmp%') AND s.ClassID ='$cid'";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.ID) LIKE UPPER('%$tmp%') AND st.Department ='$Dept'";

    }

    }	
    elseif($flag==2){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.ID)  LIKE UPPER('%$tmp%') AND $sql_dept";
      }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
        $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.ID)  LIKE UPPER('%$tmp%') AND s.ClassID ='$cid' AND $sql_dept";
      }
    $_SESSION['flag'] = 12;
    }

    $_SESSION['sql_search'] = "UPPER(s.ID) LIKE UPPER('$tmp%')";
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
elseif(!empty($_POST['Title'])){
    $tmp = mysqli_real_escape_string($link, $_REQUEST['Title']);
    if($flag==1){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Title) LIKE UPPER('%$tmp%')";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Title) LIKE UPPER('%$tmp%') AND s.ClassID ='$cid'";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Title) LIKE UPPER('%$tmp%') AND st.Department ='$Dept'";
    }
    }
    elseif($flag==2){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 && ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Title)  LIKE UPPER('%$tmp%') AND $sql_dept";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Title)  LIKE UPPER('%$tmp%') AND s.ClassID ='$cid' AND $sql_dept";
    }
    $_SESSION['flag'] = 12;
    }
    
    $_SESSION['sql_search'] = "UPPER(s.Title) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Title'.$tmp;
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
elseif(!empty($_POST['domain'])){
    $tmp = mysqli_real_escape_string($link, $_REQUEST['domain']);
    if($flag==1){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Domain) LIKE UPPER('%$tmp%')";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Domain) LIKE UPPER('%$tmp%') AND s.ClassID ='$cid'";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
       $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Domain) LIKE UPPER('%$tmp%') AND st.Department ='$Dept'";
    }
    }
    elseif($flag==2){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Domain) LIKE UPPER('%$tmp%') AND $sql_dept";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Domain) LIKE UPPER('%$tmp%') AND s.ClassID ='$cid' AND $sql_dept";
    }
    $_SESSION['flag'] = 12;
    }
    
    $_SESSION['sql_search'] = "UPPER(s.Domain) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Domain='.$tmp;
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
elseif(!empty($_POST['Guide'])){
    $tmp = mysqli_real_escape_string($link, $_REQUEST['Guide']);
    if($flag==1){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Guide) LIKE UPPER('%$tmp%')";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Guide) LIKE UPPER('%$tmp%') AND s.ClassID ='$cid'";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
       $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Guide) LIKE UPPER('%$tmp%') AND st.Department ='$Dept'";
    }
    }
    elseif($flag==2){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Guide) LIKE UPPER('%$tmp%') AND $sql_dept";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Guide) LIKE UPPER('%$tmp%') AND s.ClassID ='$cid' AND $sql_dept";
    }
    $_SESSION['flag'] = 12;
    }
    
    $_SESSION['sql_search'] = "UPPER(s.Guide) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Guide='.$tmp;
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
elseif(!empty($_POST['Organisation_pub'])){
    $tmp = mysqli_real_escape_string($link, $_REQUEST['Organisation_pub']);
    if($flag==1){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Organisation_publish) LIKE UPPER('%$tmp%')";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Organisation_publish) LIKE UPPER('%$tmp%') AND s.ClassID ='$cid'";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
       $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Organisation_publish) LIKE UPPER('%$tmp%') AND st.Department ='$Dept'";
    }
    }
    elseif($flag==2){
    if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  ($_SESSION['Desg'] == 'Principal' || $_SESSION['Desg'] == 'HOD'))){
          $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Organisation_publish) LIKE UPPER('%$tmp%') AND $sql_dept";
    }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
      $sql = "SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID where UPPER(s.Organisation_publish) LIKE UPPER('%$tmp%') AND s.ClassID ='$cid' AND $sql_dept";
    }
    $_SESSION['flag'] = 12;
    }
    
    $_SESSION['sql_search'] = "UPPER(s.Organisation_publish) LIKE UPPER('%$tmp%')";
  $_SESSION['print'] = $print.' || Organisation publish'.$tmp;
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