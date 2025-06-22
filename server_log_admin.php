<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
session_start();
$link = mysqli_connect("localhost", "root", "root", "dbms_project", 8889);

 
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

$query = "SELECT ID,Password FROM admin WHERE ID=? and Password=?";
 
 $stmt = $link->prepare($query);
     $stmt->bind_param("ss", $id,$pass);
     $stmt->execute();
     $stmt->bind_result($id,$pass);
     $stmt->store_result();
     $count = $stmt->num_rows;

if ($count == 1){
//echo "Login Credentials verified";
	$_SESSION['ctemp'] = $count;
echo "<script type='text/javascript'>alert('Login Credentials verified')
</script>";
    $_SESSION['ADID'] = $id;
    $_SESSION["login_flag"] = 3;
    $_SESSION["login_admin"] = true;
    $_SESSION["login_auth"] = false;
    $_SESSION["login"] = false;
    $_SESSION["mentor"] = false;
    $_SESSION["Desg"] = '';
    $_SESSION["Dept"] = '';
    $_SESSION["CID"] = '';
    header("location: Admin_Home.php");

//echo '<script> window.location ="Register.php"';
   
}else{
echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
//echo "Invalid Login Credentials";
}
$stmt->close();

// Close connection
mysqli_close($link);
?>