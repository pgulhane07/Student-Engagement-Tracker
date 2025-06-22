<?php
session_start();
require '../db.php';
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../index.html");
    exit;
}
$id = $_SESSION['AID'];
$classcc=substr($_SESSION['CID'], 0,3);
$cls ='';
$batch='';


        $sql = "SELECT * FROM mentor where Class= '$classcc'";
        $result = mysqli_query ($conn,$sql) or die ('Error');
         
 ?>

<html lang="en">
  <head>
    <title>Mentor Information</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../Authority_Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="access.php">Mentors Data</a>
      </li>
      
      
    </ul>
  </div>
    
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Mentors for <?php echo $classcc?></h2>
    </div>
    <div class="card-body" style="overflow: scroll;">
      <table class="table table-bordered">
        <tr>
          <th>Sr. No.</th>
          <th>Class </th>
          <th>Batch Name</th>
          <th>Batch Coordinator ID</th>
          <th>Batch Coordinator Name</th>
          <th>Roll No. from</th>
          <th>Roll No. upto</th>
          
         <th> </th>
        </tr>
         <?php if (mysqli_num_rows($result) > 0) {
  		$cnt=0;
        while ($row = mysqli_fetch_array ($result)){
        		$cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>
              
            <td><?php echo $row ['Class'];?>
              <?php $cls = $row ['Class'];?>
            </td>
             <td><?php echo $row ['Batch'];?>
              <?php $batch = $row ['Batch'];?>
            </td>
            <td><?php echo $row ['TeacherID'];?></td>
           <td><?php echo $row ['Teacher'];?></td>
           <td><?php echo $row ['Roll_from'];?></td>
           <td><?php echo $row ['Roll_to'];?></td>
            
                <td>
                  <form class="stu" action="allocate.php" method="post">
              <input  type="hidden" name="batch" value="<?php echo urlencode($batch)?>" />
              <button type="submit" style="margin:5%;" class="btn btn-info">Allocate Co-ordinator</button>
              </form>

               <form class="stu" action="allocate_roll.php" method="post">
              <input  type="hidden" name="batch" value="<?php echo urlencode($batch)?>" />
              <button type="submit" style="margin:5%;" class="btn btn-info">Allocate Roll No</button>
              </form>
              
             
            </td>
               
        </tr>
         <?php }
        } else {
          echo "0 results";
      } ?>
            
      </table>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>
<?php

?>