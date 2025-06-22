<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../../index.html");
    exit;
}
$id = $_SESSION['AID'];

$filename='';

if (isset($_POST['title']) && isset($_POST['type']) && isset($_POST['organiser'])   && isset($_POST['DO']) && isset($_POST['DE'])&& isset($_POST['staff'])  && isset($_POST['sponsorship']) ) {
  $type = $_POST['type'];
  $title = $_POST['title'];
  $organiser = $_POST['organiser'];
 $rawdate = $_POST['DO'];
   $rawdate1 = $_POST['DE'];
  $staff=$_POST['staff'];
  
  $sponsorship=$_POST['sponsorship'];
  $ds = date('Y-m-d',strtotime($rawdate));
  $de = date('Y-m-d',strtotime($rawdate1));
  $uid = uniqid("FC-");
  $sql = 'INSERT INTO formc(UID,ID,Title,Type,Organiser,Date_start,Date_end,Staff,Sponsorship) VALUES(:uid,:id,:title,:type,:organiser,:ds,:de,:staff,:sponsorship)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':title' => $title,':type' => $type,':organiser' => $organiser,':ds'=>$ds,':de'=>$de,':staff'=>$staff,':sponsorship'=>$sponsorship])) {
    $message = 'data inserted successfully';
  }
  
}
else{
    $message = 'data insertion Unsuccessful';
  }

// Uploads files



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
  <a class="navbar-brand" href="../../Authority_Home.php">Home</a>
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
      <h2>Teachers Attended Conferences, Seminars, Symposia, Workshops, FDP, STTP etc.</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
     
       <form  action="../../file/filesLogic.php?uid=<?php echo $uid?>&type=formC&flag_file=2" method="post" enctype="multipart/form-data" > 
                  <input type="file" name="myfile" id="file" >
                   <button style="margin:5%;" type="submit" name="save" class="btn btn-info">Submit</button>
       </form> 
             

        
      </form>
    </div>
  </div>
</div>

<?php

require 'footer.php';
?>