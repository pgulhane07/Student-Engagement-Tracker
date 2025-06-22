<?php
require 'config.php';
session_start();
 
 $id ='';
 $pass ='';

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
if(isset($_POST['user'])){
	$id = mysqli_real_escape_string($link, $_REQUEST['user']);
	$pass = mysqli_real_escape_string($link, $_REQUEST['pass']);
}

$query = "SELECT ID,Password FROM student WHERE ID=? and Password=?";
 
     $stmt = $link->prepare($query);
     $stmt->bind_param("ss", $id,$pass);
     $stmt->execute();
     $stmt->bind_result($id,$pass);
     $stmt->store_result();
     $count = $stmt->num_rows;

if ($count == 1){
//echo "Login Credentials verified";
echo "<script type='text/javascript'>alert('Login Credentials verified')
</script>";
    $_SESSION['ID'] = $id;
    $_SESSION["login_flag"] = 1;
    $_SESSION["login"] = true;
    $_SESSION["login_auth"] = false;
    $_SESSION["login_admin"] = false;

    header("location: Student_Home.php");
   
}else{
echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
}
$stmt->close();

// Close connection
mysqli_close($link);
?>