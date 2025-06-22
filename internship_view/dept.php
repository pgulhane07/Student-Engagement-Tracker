<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$cid = isset($_SESSION['CID']) ? $_SESSION['CID'] : '';
$sql_search = isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 2;
if($flag == 0 || $flag == 21 || $flag == 12){
	$flag=2;
	$_SESSION['flag']=$flag;
}
$dept ='';
$year ='';
$div ='';
$print = $_SESSION['print'];

if(empty($_POST['dept'])){
    $dept = $_SESSION['Dept'];
    $year = mysqli_real_escape_string($link,$_REQUEST['year']);
    $div = mysqli_real_escape_string($link,$_REQUEST['division']);
    $div1 = $year.$div;
    if(!empty($_POST['year']) && empty($_POST['division'])){	
        if($flag == 2 && $_SESSION['login_flag'] == 2){
            $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND st.Year = '$year'";
        }
        elseif($flag == 1 && $_SESSION['login_flag'] == 2){
            $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND st.Year = '$year'  AND $sql_search";
             $_SESSION['flag'] = 21;
        }	 
        $_SESSION['print'] = $print.' || Year='.$year;

    }
    else if(!empty($_POST['year']) && !empty($_POST['division'])){
        if($flag == 2 && $_SESSION['login_flag'] == 2){
             $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND st.Class = '$div1' ";
        }
        elseif($flag == 1 && $_SESSION['login_flag'] == 2){
            $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND st.Class = '$div1' AND $sql_search ";
            $_SESSION['flag'] = 21;
        }
        $_SESSION['print'] = $print.' || Div='.$div1;
    } 
      $_SESSION['sql_dept'] = " st.Department ='$dept' ";
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

else if(!empty($_POST['dept']) && empty($_POST['year']) && empty($_POST['division'])){
    $dept = mysqli_real_escape_string($link,$_REQUEST['dept']);
    if($flag == 2 && (($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal'))){
            $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
    }
    elseif($flag == 1 && (($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal'))){
            $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND $sql_search";
        $_SESSION['flag'] = 21;
    }	  
      $_SESSION['sql_dept'] = " st.Department ='$dept' ";
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
elseif(!empty($_POST['dept']) && !empty($_POST['year']) && empty($_POST['division'])){
    $dept = mysqli_real_escape_string($link,$_REQUEST['dept']);
    $year = mysqli_real_escape_string($link,$_REQUEST['year']);
    if($flag == 2 && (($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal'))){
            $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND st.Year = '$year'";
    }
    elseif($flag == 1 && (($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal'))){
            $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND st.Year = '$year'  AND $sql_search";
        $_SESSION['flag'] = 21;
    }
      
      $_SESSION['sql_dept'] = " st.Department ='$dept' AND st.Year = '$year' ";
      $_SESSION['print'] = $print.' || Department='.$dept.' || Year='.$year;
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
elseif(!empty($_POST['dept']) && !empty($_POST['year']) && !empty($_POST['division'])){
    $dept = mysqli_real_escape_string($link,$_REQUEST['dept']);
    $year = mysqli_real_escape_string($link,$_REQUEST['year']);
    $div = mysqli_real_escape_string($link,$_REQUEST['division']);
    $div1 = $year.$div;
    if($flag == 2 && (($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal'))){
             $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND st.Class = '$div1' ";
    }
    elseif($flag == 1 && (($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal'))){
            $sql="SELECT s.*,st.Rollno,st.Year,st.Full_Name FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept' AND st.Class = '$div1' AND $sql_search ";
        $_SESSION['flag'] = 21;
    }
     
      $_SESSION['sql_dept'] = " st.Department ='$dept' AND st.Year = '$year' AND st.Class = '$div1' ";
      $_SESSION['print'] = $print.' || Div'.$div1;
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

}
else{
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