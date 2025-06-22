<?php

session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$aid = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$Dept = $_SESSION['Dept'];
$id='';
$sql='';
$result='';
        $usernm="root";
        $passwd="";
        $host="localhost";
        $database="dbms_project";

        $conn = mysqli_connect($host,$usernm,$passwd,$database);

        if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
}

        if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){
           $sql = "SELECT * FROM  authority ";          

        }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){
           $sql = "SELECT * FROM  authority WHERE Department ='$Dept' ";

        }   

        $result = mysqli_query ($conn,$sql) or die ('Error');
         
 ?>

<html lang="en">
  <head>
    <title>A.Select teacher</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/projects/Auth_page1.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>View Teacher Data Teacher</h2>
    </div>
    <div class="card-body" style="overflow: scroll;">
      <table class="table table-bordered">
        <tr>
          <th>Sr. No.</th>
          <th>Teacher ID</th>
          <th>Teacher Name </th>
          <th>Designation </th>
          
         <th> </th>
        </tr>
         <?php if (mysqli_num_rows($result) > 0) {
  		$cnt=0;
        while ($row = mysqli_fetch_array ($result)){
        		$cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>
              
            <td><?php echo $row ['ID'];?>
             
            </td>

             <?php $id = $row ['ID'];?>
          
           <td><?php echo $row ['Full_Name'];?></td>
            <td><?php echo $row ['Designation'];?></td>
            
                <td>
                  <form class="stu" action="teacher_profile/view_profile.php" method="post">
              <input  type="hidden" name="id" value="<?php echo urlencode($id)?>" />
            
              <button type="submit" style="margin:5%;" class="btn btn-info">View Profile</button>
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


<?php
}else{
  if($_SESSION['login_flag'] == 2){
        header("location: ../Authority_login.php");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../Admin_login.php");
        exit;
    }
    
    
}
