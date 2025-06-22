<?php
session_start();
require '../db.php';
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
    header("location: ../Admin_login.html");
    exit;
}

  if(isset($_POST['search'])){ 
  $no = $_POST['search'];
  $sql = '';
  if($no == 1){
    $c1 = $_POST['c1'];
    $b1 = $_POST['b1'];
    $sql = "INSERT into mentor(Class,Batch) VALUES ('$c1','$b1')";
  }
  else if($no == 2){
    $c1 = $_POST['c1'];
    $b1 = $_POST['b1'];
    $c2 = $_POST['c2'];
    $b2 = $_POST['b2'];
    $sql = "INSERT into mentor(Class,Batch) VALUES ('$c1','$b1'),('$c2','$b2')";
  }
  else if($no == 3){
    $c1 = $_POST['c1'];
    $b1 = $_POST['b1'];
    $c2 = $_POST['c2'];
    $b2 = $_POST['b2'];
    $c3 = $_POST['c3'];
    $b3 = $_POST['b3'];
    $sql = "INSERT into mentor(Class,Batch) VALUES ('$c1','$b1'),('$c2','$b2'),('$c3','$b3')";
  }
  else if($no == 4){
    $c1 = $_POST['c1'];
    $b1 = $_POST['b1'];
    $c2 = $_POST['c2'];
    $b2 = $_POST['b2'];
    $c3 = $_POST['c3'];
    $b3 = $_POST['b3'];
    $c4 = $_POST['c4'];
    $b4 = $_POST['b4'];
    $sql = "INSERT into mentor(Class,Batch) VALUES ('$c1','$b1'),('$c2','$b2'),('$c3','$b3'),('$c4','$b4')";
  }

        $result = mysqli_query ($conn,$sql) or die ('Error');
        if($result){
           header("location: view.php");
         }

  }
 ?>
        

<html lang="en">
  <head>
    <title>Add Mentor Batch</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../Admin_Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="view.php">Mentor Batches</a>
      </li>    
      
    </ul>
  </div>
    
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Add Batches</h2>
    </div>
    <div class="card-body" style="overflow: scroll;">
       <form class="form" action="add.php" method="post" enctype="multipart/form-data" >
      <input list="search" name="search" id="srch" onchange="myFunction(this)" class="input-field center" autocomplete="off" placeholder="Enter No. of batches">
              <datalist id="search">
                <select name="searchs" id="searchs" >
                <option  value="1">1</option>
                <option  value="2">2</option>
                <option  value="3">3</option>
                <option  value="4">4</option>
                </select>     
              </datalist><br><br>

            <div class="input-group" id="cb1" style="display: none;">
              <input name="c1" type="text" placeholder="Class 1" class="input-field">
              <input name="b1" type="text" placeholder="Batch 1" class="input-field"> <br><br>              
            </div> 
            <div class="input-group" id="cb2" style="display: none;">

              <input name="c2" type="text" placeholder="Class 2" class="input-field">
              <input name="b2" type="text" placeholder="Batch 2" class="input-field"> <br><br>
            </div> 
            <div class="input-group" id="cb3" style="display: none;">
              <input name="c3" type="text" placeholder="Class 3" class="input-field">
              <input name="b3" type="text" placeholder="Batch 3" class="input-field"> <br><br>
            </div> 
            <div class="input-group" id="cb4" style="display: none;">
              <input name="c4" type="text" placeholder="Class 4" class="input-field">
              <input name="b4" type="text" placeholder="Batch 4" class="input-field"> <br><br>
            </div> 
            <div class="input-group" id="b" style="display: none;">
            <button  type="submit" class="form-button">Add
              </button>
            </div>
         </form>
         </div> 
 </div>
  </div>

  <script type="text/javascript">
  function myFunction(option){
          var opt = option.value;
          if(opt == "1"){
            document.getElementById("cb1").style.display = "block";
            document.getElementById("b").style.display = "block";
          }
          if(opt == "2"){
            document.getElementById("cb1").style.display = "block";
            document.getElementById("cb2").style.display = "block"; 
            document.getElementById("b").style.display = "block";      
          }
          if(opt == "3"){
            document.getElementById("cb1").style.display = "block";
            document.getElementById("cb2").style.display = "block";
            document.getElementById("cb3").style.display = "block";
            document.getElementById("b").style.display = "block";
          }
          if(opt == "4"){
            document.getElementById("cb1").style.display = "block";
            document.getElementById("cb2").style.display = "block";
            document.getElementById("cb3").style.display = "block";
            document.getElementById("cb4").style.display = "block";
            document.getElementById("b").style.display = "block";
          }
      }
</script> 
<?php require 'footer.php'; ?>
</body>
</html>