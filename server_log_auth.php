<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once "config.php";
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

$query = "SELECT ID,Password FROM authority WHERE ID=? and Password=?";
 
     $stmt = $link->prepare($query);
     $stmt->bind_param("ss", $id,$pass);
     $stmt->execute();
     $stmt->bind_result($id,$pass);
     $stmt->store_result();
     $count = $stmt->num_rows;
    
if ($count == 1){
//echo "Login Credentials verified";
    session_start();
    // Store data in session variables
    $_SESSION["login_auth"] = true;
    $_SESSION["login_admin"] = false;
    $_SESSION["login"] = false;
    $_SESSION["login_flag"] = 2;
    $_SESSION['AID'] = $id;
    $_SESSION['CID'] = '';
    $_SESSION['Desg'] = '';
    $_SESSION['Dept'] = '';
echo "<script type='text/javascript'>alert('Login Credentials verified')
</script>";
    
    header("location: Authority_Home.php");

//echo '<script> window.location ="Register.php"';
   
}else{
  //  header("location: Auth_login.php");
echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
//echo "Invalid Login Credentials";
}
$stmt->close();

// Close connection
mysqli_close($link);
?>