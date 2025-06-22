<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../../index.html");
    exit;
}
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
$message = '';
$sql = 'SELECT * FROM formb WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset ($_POST['activity'])  && isset($_POST['title']) && isset($_POST['speaker'])   && isset($_POST['DO'])  && isset($_POST['DE']) && isset($_POST['participant'])  && isset($_POST['remark']) ) {
  $activity = $_POST['activity'];
  $title = $_POST['title'];
  $speaker = $_POST['speaker'];
  
  $rawdate = $_POST['DO'];
  $rawdate1 = $_POST['DE'];
  $participant=$_POST['participant'];
  
  $remark=$_POST['remark'];
  $ds = date('Y-m-d',strtotime($rawdate));
  $de = date('Y-m-d',strtotime($rawdate1));


   $sql = 'UPDATE formb SET Activity=:activity,Title=:title,Speaker=:speaker,Date_start=:ds,Date_end=:de,Participants=:participant,Remarks=:remark WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':activity' => $activity,':title' => $title,':speaker' => $speaker,':ds' => $ds,':de' => $de, ':uid' => $uid,':participant'=>$participant,':remark'=>$remark,':uid' => $uid])) {
    header("Location: index.php");
  }
  
}
else{
     $message = 'data updation Unsuccessful';
  }
  
 ?>
 <html lang="en">
  <head>
    <title>Edit </title>
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
        <a class="nav-link" href="create.php">Add Data</a>
      </li>
      
      
    </ul>
  </div>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Edit</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        
        <div class="form-group">
          <label for="activity">Activity/Event</label>
          <input value="<?= $person->Activity; ?>" type="text" name="activity" id="activity" class="form-control">
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input value="<?= $person->Title; ?>" type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="speaker">Speaker/Resource Person</label>
          <input value="<?= $person->Speaker; ?>" type="text" name="speaker" id="speaker" class="form-control">
        </div>
        
          <div class="form-group">
          <label for="DO">Start Date</label>
          <input value="<?= $person->Date_start; ?>" type="date" name="DO" id="DO" class="form-control">
        </div>
        <div class="form-group">
          <label for="DE">End Date</label>
          <input value="<?= $person->Date_end; ?>" type="date" name="DE" id="DE" class="form-control">
        </div>
         <div class="form-group">
          <label for="participant">No. of Participants</label>
          <input value="<?= $person->Participants; ?>" type="text" name="participant" id="participant" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="remark">Remarks</label>
          <input value="<?= $person->Remarks; ?>" type="text" name="remark" id="remark" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
require 'footer.php';
?>