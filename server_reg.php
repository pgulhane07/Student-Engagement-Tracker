<?php
$link = mysqli_connect("localhost", "root", "root", "dbms_project", 8889);
 
 $id ='';
 $fname ='';
 $lname ='';
 $cls ='';
 $year ='';
 $roll ='';
 $depart ='';
 $mno ='';
 $email ='';
 $address= '';
 $pass ='';
 $date ='';
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
if(isset($_POST['user'])){
	$id = mysqli_real_escape_string($link, $_REQUEST['user']);
	$fname = mysqli_real_escape_string($link, $_REQUEST['fname']);
	$cls = mysqli_real_escape_string($link, $_REQUEST['class']);
	$roll = mysqli_real_escape_string($link, $_REQUEST['rollno']);
	$year = substr($cls,0,2);
	$CID = $cls.'_'.date("Y");
	$depart = mysqli_real_escape_string($link, $_REQUEST['depart']);
	$mno = mysqli_real_escape_string($link, $_REQUEST['mobile']);
	$email = mysqli_real_escape_string($link, $_REQUEST['email']);
	$address = mysqli_real_escape_string($link, $_REQUEST['address']);
}



if(isset($_POST['pass1'])){
	
	if($_POST['pass1'] == $_POST['pass2']){
		$pass = mysqli_real_escape_string($link, $_REQUEST['pass1']);
	}
	else{
		$_SESSION['Error'] = "Password Mismatch";
	}
}


if(isset($_POST['date'])){
	$rawdate = mysqli_real_escape_string($link, $_REQUEST['date']);
	$date = date('Y-m-d',strtotime($rawdate));
}

$SELECT = "SELECT ID From stu_temp Where ID = ? Limit 1";
     // Attempt insert query execution

     $stmt = $link->prepare($SELECT);
     $stmt->bind_param("s", $id);
     $stmt->execute();
     $stmt->bind_result($id);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $sql = "INSERT INTO stu_temp (ID, Full_Name,Class,Rollno,Year,Department,ClassID,DOB,Email,Mobile,Address,Password) VALUES ('$id', '$fname', '$cls', '$roll', '$year', '$depart', '$CID','$date','$email','$mno','$address','$pass')";

      if(isset($_SESSION['Error'])){
		echo $_SESSION['Error'];
		unset($_SESSION['Error']);	
		}else{
		if(mysqli_query($link, $sql)){
    		//echo "Records added successfully.";
    		$registration_confirmation = "You have successfully registered for PICT Student Data Management Program.";
			$to = "$email";
			$subject = "PICT Student Data Management Program Registration";

			$message = "
			<html>
			<head>
			<title>Registration Confirmed!!!</title>
			</head>
			<body>
			<p> $registration_confirmation </p>
			<p>Information about Login:</p>
			<p>Registration-Id: ".$id."</p>
			<p>Mobile No: " .$mno. "</p>
			<p>Link: http://pictinc.org/</p>
			<p>For more details, contact: <br>Sourav Patil : +91 9422473089 <br> Email ID : souravpatil1859@gmail.com<br>Thanks for registration<br>PICT Student Data Management Program Web Team</p>
			</body>
			</html>
			";

			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <souravpatil1859@gmail.com>' . "\r\n";
			$headers .= 'Bcc: souravpatil1859@gmail.com' . "\r\n";
			mail($to,$subject,$message,$headers);
    		header("location: index.html");
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