<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require_once "config.php";
//$link =mysqli_connect("localhost", "root", "root", "dbms_project", 8889);
 
 $id ='';
 $fname ='';
 $lname ='';
 $cls ='';
 $depart ='';
 $mno ='';
 $email ='';
 $desgn= '';
 $pass ='';
 $pass3='';

 
// Escape user inputs for security
if(isset($_POST['user'])){
	$id = mysqli_real_escape_string($link, $_REQUEST['user']);
	$fname = mysqli_real_escape_string($link, $_REQUEST['fname']);
	$desgn = mysqli_real_escape_string($link, $_REQUEST['desgn']);
	$depart = mysqli_real_escape_string($link, $_REQUEST['depart']);
	$mno = mysqli_real_escape_string($link, $_REQUEST['mobile']);
	$email = mysqli_real_escape_string($link, $_REQUEST['email']);
	$pass3 = 'pict123';
	
}


if(isset($_POST['pass1']) && isset($_POST['pass3'])){
	
	if($_POST['pass3'] === 'pict123'){
		if($_POST['pass1'] == $_POST['pass2']){
		$pass = mysqli_real_escape_string($link, $_REQUEST['pass1']);
		}
		else{
		$_SESSION['Error'] = "Password Mismatch";
		}
	}
	else{
		$_SESSION['Error'] = "You are Not the Authorized Person";
		echo "<script type='text/javascript'>alert('You are not the Authorized Person')</script>";
	}
	
}


$SELECT = "SELECT ID From authority Where ID = ? Limit 1";
     // Attempt insert query execution

     $stmt = $link->prepare($SELECT);
     $stmt->bind_param("s", $id);
     $stmt->execute();
     $stmt->bind_result($id);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $sql = "INSERT INTO authority (ID, Full_Name,Designation,Class,Department,Email,Mobile,Password) VALUES ('$id', '$fname', '$desgn', '$cls', '$depart','$email','$mno','$pass')";

      if(isset($_SESSION['Error'])){
		echo $_SESSION['Error'];
		unset($_SESSION['Error']);	
		}else{
		if(mysqli_query($link, $sql)){
    		echo "Records added successfully.";
    			header("location: Auth_login.php");
			} else{
    			echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
				}
		}
     } else {
      echo "Someone already registered using this Reg. ID";
     }
     $stmt->close();
 
 
// Close connection
mysqli_close($link);
?>