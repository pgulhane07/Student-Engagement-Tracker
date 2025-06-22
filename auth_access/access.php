<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header('location:../Admin_login.html');
}

$id = $_SESSION['ADID'];
$cls ='';

$sql = "SELECT access.Class,access.TeacherID,authority.Full_Name FROM access INNER JOIN authority  ON access.Class=authority.Class";

$statement = $connection->prepare($sql);
$statement->execute();
$people = isset($_SESSION['people1']) ? $_SESSION['people1'] : $statement->fetchAll(PDO::FETCH_OBJ);

$column = isset($_SESSION['column']) ? $_SESSION['column'] : 'None';
$sort_order = isset($_SESSION['order']) ? $_SESSION['order'] : 'None';
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

        
        $result = mysqli_query ($link,$sql) or die ('Error');
         
 ?>

<html lang="en">
  <head>
    <title>Class Allocation</title>
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

th:hover{
     cursor:pointer;
    background:#000;
    
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
              <a class="nav-link extra" href="../logout_admin.php">Logout</a>
              
         </li>
    </ul>
    
    </div>
  </nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Class Allocation</h2>
    </div>
    <div class="card-body" style="overflow: scroll;">
      <table class="table table-bordered">
       <thead>
        <tr style="font-size: 14.3px;">
          <th style="width: 130px;" >
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="access.Class">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Class<i class="fas fa-sort<?php echo $column == 'access.Class' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="access.TeacherID">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Class Coordinator Reg.ID<i class="fas fa-sort<?php echo $column == 'access.TeacherID' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="authority.Full_Name">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Class Coordinator Name<i class="fas fa-sort<?php echo $column == 'authority.Full_Name' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>
          <th> </th>
        </tr>
       </thead>  
       <tbody>
         <?php foreach($people as $person): ?>
        <tr>
              
            <td><?php echo $person->Class;?>
              <?php $cls = $person->Class;?>
            </td>
            <td><?php echo $person->TeacherID;?></td>
           <td>Prof. <?php echo $person->Full_Name;?></td>
            
                <td>
                  <form class="stu" action="index.php" method="post">
              <input  type="hidden" name="cls" value="<?php echo urlencode($cls)?>" />
              <button type="submit" style="margin:5%;" class="btn btn-info">Change Co-ordinator</button>
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