<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.html');
}
$dsg = isset($_SESSION['Desg']) ? $_SESSION['Desg'] : '' ;
$dpt = isset($_SESSION['Dept']) ? $_SESSION['Dept'] : '' ;
$id = $_SESSION['ADID'];
$people =$_SESSION['people'];
$print = isset($_SESSION['print']) ? $_SESSION ['print'] : '';
$sid ='';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 0;
$_SESSION['flag'] = $flag;
  if($flag == 1){
    $sql_search = isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';  
  }
  elseif($flag == 2){
    $sql_dept = isset($_SESSION['sql_dept']) ? $_SESSION['sql_dept'] : '';
  }
  if($flag == 12 || $flag ==21){
    $sql_search = isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';
    $sql_dept = isset($_SESSION['sql_dept']) ? $_SESSION['sql_dept'] : '';
  }
   
   
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Allocate teacher</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,500i,700,800i" rel="stylesheet">
  <link rel="stylesheet" href="../css/NavStyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  
<style type="text/css">

th{
  background:#47cad1;
}

th a i {
    color: rgba(255,255,255,0.4);
}
</style> 

  </head>


  <body class="bg-info" style="overflow: scroll">
    <nav class="navbar navbar-expand-custom navbar-light darker">
      <a class="navbar-brand gap" href="../Admin_Home.php">Home</a>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item gap2">
              <a class="nav-link" href="access.php">Designation Allocation</a>
            </li>

            <li class="nav-item gap2">
              <a class="nav-link" href="index.php">Show All Teachers</a>
            </li>
      
           
          <li class="nav-item gap2">
            <form class="form" action="dept.php" method="post" enctype="multipart/form-data" >
           <input list="search1" type="text" name="dept" id="srch1" class="input-field" autocomplete="off" placeholder="Department" required >
            <datalist id="search1">
              <select  name="search1" id="searchs1">
              <option  value="Computer">Computer</option>
              <option  value="IT">IT</option>
              <option  value="ENTC">ENTC</option>
              </select>  
            </datalist>
           
            <button type="submit" class="form-button extra" ></span><i class="fa fa-search"></i>
              </button>

        </form>
          </li>
           
          <li class="nav-item gap2">
          <form class="form" action="search.php" method="post" enctype="multipart/form-data" >
          <input list="search" name="search" id="srch" onchange="myFunction(this)" class="input-field center" autocomplete="off" placeholder="Search By">
              <datalist id="search">
                <select name="searchs" id="searchs" >
                <option  value="Reg.ID">Reg.ID</option>  
                <option  value="Full Name">Full Name</option>
                </select>     
              </datalist>
            <div class="input-group" id="id" style="display: none;">
              <input name="regid" type="text" placeholder="Enter Reg.ID" class="input-field">
                <button  type="submit" class="form-button"></span><i class="fa fa-search"></i>
                </button>
            </div>  
            <div class="input-group" id="act" style="display: none;">
              <input name="Full_Name" type="text" placeholder="Enter Full Name" class="input-field">
                <button  type="submit" class="form-button"></span><i class="fa fa-search"></i>
                </button>
            </div> 
          </li>
         </form> 
        </li>

         <li class="nav-item gap2">
              <a class="nav-link extra" href="../logout_admin.php">Logout</a>
              
         </li>
    </ul>
    
    </div>
  </nav>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('.navbar-light .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
});
</script>
<script type="text/javascript">
  function myFunction(option){
          var opt = option.value;
          if(opt == "Reg.ID"){
            document.getElementById("id").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Full Name"){
            document.getElementById("act").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
      }
</script>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Designation Allocation for <?php echo $dsg ?> <?php echo $dpt ?> </h2>
    </div>
    <div class="card-body" style="overflow: scroll;">
      <table class="table table-bordered">
       <thead>
        <tr>
          <th>Teacher ID</th>
          <th>Teacher Name</th>          
         <th> </th>
        </tr>
       </thead>  
       <tbody>
        <?php foreach($people as $person): ?>
          <tr>
            <td><?= $person->ID; ?></td>
            <?php $sid = $person->ID;?>
            <td>Prof. <?= $person->Full_Name; ?></td>
            <td>
              <form class="stu" action="change.php" method="post">
              <input  type="hidden" name="sid" value="<?php echo urlencode($sid)?>" />
              <button type="submit" style="margin:5%;" class="btn btn-info">add</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
       </tbody>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>

<?php

?>