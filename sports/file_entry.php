<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../index.html");
    exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$_SESSION['type'] = 'Sports';
$_SESSION['flag_file'] = 1; 
$type ='';
$message = '';
$uid = uniqid("SP-");
$filename='';

if (isset ($_POST['Type'])  && isset($_POST['Description']) && isset($_POST['Venue']) && isset($_POST['Achievements'])  && isset($_POST['DOB']) ) {
  $type = $_POST['Type'];
  $descp = $_POST['Description'];
  $venue = $_POST['Venue'];
  $achieve = $_POST['Achievements'];
  $class = '';
  $rawdate = $_POST['DOB'];
  $dob = date('Y-m-d',strtotime($rawdate));

  $sql1 = "SELECT ClassID FROM student WHERE ID = '$id'";
  $result1 = mysqli_query ($conn,$sql1) or die ('Error');
  if(mysqli_num_rows($result1)!=0)
  {
    $row = mysqli_fetch_array ($result1);
    $class = $row ['ClassID'];
  }

  $sql = 'INSERT INTO sports(UID,ID,ClassID,Sports_Name,Description,Venue,Achievements,Date_Sports) VALUES(:uid,:id,:cid,:type,:descp,:venue,:achieve,:dob)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':cid' => $class,':type' => $type,':descp' => $descp,':venue' => $venue,':achieve' => $achieve,':dob' => $dob])) {
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
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,500i,700,800i" rel="stylesheet">
  <link rel="stylesheet" href="../css/NavStyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-custom navbar-light darker">
        <a class="navbar-brand gap" href="/projects/stu_page1.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item gap2">
              <a class="nav-link" href="index.php">Achievements</a>
            </li>
            <li class="nav-item gap2">
              <a class="nav-link" href="">Add Achievements</a>
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