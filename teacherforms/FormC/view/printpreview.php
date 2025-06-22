<?php

session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$people =$_SESSION['people'];
 ?>



<!DOCTYPE html>
<html>
<head>
	<title>FormA Print</title>
	 <link rel="stylesheet" type="text/css" href="../../../css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="../../../css/printpreview.css"  />

</head>
<body>
  <a href="index.php">Go Back</a>
    <div class="tabs" >
          <center><h2>FormC Report</h2></center>
      <table style="width: 100%;" >

        <tr>
          <th>Sr. No.</th>
         
          
          <th>Title</th>
          <th>Type/ Nature</th>
          <th>Name of Organiser</th>
          <th>Name of Staff</th>
          <th>Sponsorship Details</th>
   
          <th>Start Date(Y-M-D)</th>
          <th>End Date(Y-M-D)</th>
          
           
        </tr>
         <?php 
            $cnt=0;
        foreach($people as $person):
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>   
           
            <td><?= $person->Title; ?></td>
            <td><?= $person->Type; ?></td>
            <td><?= $person->Organiser; ?></td>
            <td><?= $person->Staff; ?></td>
            <td><?= $person->Sponsorship; ?></td>
           
            <td><?= $person->Date_start; ?></td>   
            <td><?= $person->Date_end; ?></td>    
               
        </tr>
         <?php endforeach; ?>
            
      </table>
      </div>

      <div style="padding-top: 50px">
<center><button class="control-group" onclick="window.print()"><b>Print Report</b></button>  </center>

</div>

</body>
</html>

<?php }else{
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