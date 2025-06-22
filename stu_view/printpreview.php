<?php

session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$people =$_SESSION['people'];
 ?>



<!DOCTYPE html>
<html>
<head>
	<title>All Students Print</title>
	 <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="../css/printpreview.css"  />

</head>
<body>

  <a href="index.php">Go Back</a>

    <div class="tabs" >
          <center><h2>Students Report</h2></center>
      <table style="width: 100%;" >

        <tr>
          <th>Sr. No.</th>
          <th>Full Name</th>
          <th>Class</th>
          <th>Roll No</th>
          <th>Year</th>
          <th>Department</th>
          <th>Date of birth(YYYY-MM-DD)</th>
          <th>Email</th>
          <th>Mobile</th>
          <th>Address</th>
          
           
        </tr>
         <?php 
            $cnt=0;
        foreach($people as $person):
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>   
            <td><?= $person->Full_Name; ?></td>
            <td><?= $person->Class; ?></td>
            <td><?= $person->Rollno; ?></td>
            <td><?= $person->Year; ?></td>
            <td><?= $person->Department; ?></td>    
            <td><?= $person->DOB; ?></td> 
            <td><?= $person->Email; ?></td> 
            <td><?= $person->Mobile; ?></td> 
            <td><?= $person->Address; ?></td>   
               
        </tr>
         <?php endforeach; ?>
            
      </table>
      </div>

      <div style="padding-top: 50px">
<center><button class="control-group" onclick="window.print()"><b>Print Report</b></button> </center>

</div>

</body>
</html>

<?php }else{
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