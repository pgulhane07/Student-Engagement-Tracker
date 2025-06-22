<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../Home_page.php");
    exit;
}
$_SESSION['type']='Project';
$_SESSION['flag_file']=1;
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$message = '';  
$uid = uniqid("PRC-");
$filename='';

if (isset ($_POST['Title'])  && isset ($_POST['Domain'])  && isset ($_POST['Type'])  && isset($_POST['Description']) && isset ($_POST['Guide']) && isset ($_POST['Sponsor'])  && isset($_POST['Venue']) && isset($_POST['Achievements'])  && isset($_POST['DOB']) ) {
     $title =$_POST['Title'];
     $domain =$_POST['Domain'];
     $guide =$_POST['Guide'];
     $sponsor = !empty($_POST['company']) ? $_POST['company'] : 'No';
     $type = $_POST['Type'];
     $descp = $_POST['Description'];
     $venue = $_POST['Venue'];
     $achieve = $_POST['Achievements'];
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

  $sql = 'INSERT INTO project_competition(UID,ID,ClassID,Title,Domain,Type,Description,Guide,Sponsor,Achievement,Venue,Date_Proj) VALUES(:uid,:id,:cid,:title,:domain,:type,:descp,:guide,:sponsor,:achieve,:venue,:dob)';
  $statement = $connection->prepare($sql);

  if ($statement->execute([':uid' => $uid,':id' => $id,':cid' => $class,':title' => $title,':domain' => $domain,':type' => $type,':descp' => $descp,':guide' => $guide,':sponsor' => $sponsor,':venue' => $venue,':achieve' => $achieve,':dob' => $dob])) {
         $message = 'data inserted successfully';
     }
  
}
else{
    $message = 'data insertion Unsuccessful';
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
  <a class="navbar-brand" href="/projects/Auth_page1.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Achievements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Add Data</a>
      </li>
      
    </ul>
  </div>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Add Certificate</h2>
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