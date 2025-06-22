<?php

session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$people =$_SESSION['people'];
 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Internship Print</title>
	 <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="../css/printpreview.css"  />

</head>
<body>

    <div class="tabs" >
          <center><h2>Students Internship Report</h2></center>
      <table style="width: 100%;" >

        <tr>
          <th>Sr. No.</th>
          <th>Full Name</th>
          <th>Roll No.</th>
          <th>Company</th>
          <th>Address</th>
          <th>Duration</th>
          <th>Type</th>
          <th>Job Role</th>
          <th>Description</th>
          <th>Stipend</th>
          <th>Source</th>
          <th>Approve</th>
          <th>Date Join </th>
          <th>Date End</th>
          
           
        </tr>
         <?php 
            $cnt=0;
        foreach($people as $person):
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>   
            <td><?= $person->Full_Name; ?></td>
            <td><?= $person->Rollno; ?></td>
            <td><?= $person->Company; ?></td>
            <td><?= $person->Address; ?></td>
            <td><?= $person->Duration; ?></td>
            <td><?= $person->Type; ?></td>
            <td><?= $person->Job_Role; ?></td>   
            <td><?= $person->Description; ?></td>
            <td><?= $person->Stipend; ?></td>
            <td><?= $person->Source; ?></td>
            <td><?= $person->Approve; ?></td>
            <td><?= $person->Date_Join; ?></td>
            <td><?= $person->Date_End; ?></td>
               
        </tr>
         <?php endforeach; ?>
            
      </table>
      </div>

      <div style="padding-top: 50px">
<center><button class="control-group" onclick="window.print()"><b>Print Report</b></button> </center>

</div>

</body>
</html>

<?php }
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