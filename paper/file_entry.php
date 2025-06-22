<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../index.html");
    exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$message = '';
$uid = uniqid("PP-");
$filename='';
$_SESSION['type']='Paper';
$_SESSION['flag_file']=1;

if (isset ($_POST['Type'])  && isset($_POST['Domain']) && isset($_POST['Guide']) && isset($_POST['publish'])  && isset($_POST['DOB']) ) {
    $type = $_POST['Type'];
    $dom = $_POST['Domain'];
    $guide = $_POST['Guide'];
    $pub = $_POST['publish'];
    $rawdate = $_POST['DOB'];
    $dob = date('Y-m-d',strtotime($rawdate));
    $class = '';
    $sql1 = "SELECT ClassID FROM student WHERE ID = '$id'";
    $result1 = mysqli_query ($conn,$sql1) or die ('Error');
    if(mysqli_num_rows($result1)!=0)
    {
      $row = mysqli_fetch_array ($result1);
      $class = $row ['ClassID'];
    }

    $sql = 'INSERT INTO paper_presentation(UID,ID,ClassID,Title,Domain,Guide,Organisation_publish,Date_publish) VALUES(:uid,:id,:cid,:type,:dom,:guide,:pub,:dob)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':uid' => $uid,':id' => $id,':cid' => $class,':type' => $type,':dom' => $dom,':guide' => $guide,':pub' => $pub,':dob' => $dob])) {
      $message = 'Data inserted successfully';
    }
    
  }
  else{
      $message = 'Data insertion Unsuccessful';
    }
   
  
  ?>
<html lang="en">
  <head>
    <title>Create</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../Student_Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Presentations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Add Presentation</a>
      </li>
      
    </ul>
  </div>
  
</nav>  
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Add Presenation</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
     
       <form  action="../file/filesLogic.php?uid=<?php echo $uid?>" method="post" enctype="multipart/form-data" > 
                  <input type="file" name="myfile" id="file" >
                   <button style="margin:5%;" type="submit" name="save" class="btn btn-info">Submit</button>
                </form> 
             
             
      </form>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>