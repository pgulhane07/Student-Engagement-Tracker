<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = isset($_SESSION['A']) ? $_SESSION['A'] : '';
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
$message = '';
$sql = 'SELECT * FROM formt WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset ($_POST['name'])  && isset($_POST['no']) && isset($_POST['dur'])   && isset($_POST['prize']) && isset($_POST['remark']) && isset($_POST['organizer'])  && isset($_POST['DO']) && isset($_POST['DE']) ) {

  $name = $_POST['name'];
  $organizer=$_POST['organizer'];
  $no = $_POST['no'];
  $dur = $_POST['dur'];
  $prize = $_POST['prize'];
  $remark = $_POST['remark'];
  
  $rawdate = $_POST['DO'];
  $rawdate1 = $_POST['DE'];
 $ds = date('Y-m-d',strtotime($rawdate));
  $de = date('Y-m-d',strtotime($rawdate1));


   $sql = 'UPDATE formt SET Name=:name,Organizer=:organizer,Participants=:no,Duration=:dur,Prize=:prize,Remark=:remark,Date_start=:ds,Date_end=:de WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name,':organizer'=>$organizer,':no' => $no,':dur' => $dur,':prize' => $prize,':remark' => $remark,':ds' => $ds,':de' => $de,'uid' => $uid])) {
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
    <h2>Edit Achievement of Reg.ID : <?php echo $id; ?></h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        
        <div class="form-group">
          <label for="name">Name of the Activity</label>
          <input value="<?= $person->Name; ?>" type="text" name="name" id="name" class="form-control">
        </div>

        <div class="form-group">
         <label for="organizer">Organizer </label>
          <input value="<?= $person->Organizer; ?>" type="text" name="organizer" id="organizer" class="form-control">
        </div>

        <div class="form-group">
           <label for="no">Name/No. of participants</label>
          <input value="<?= $person->Participants; ?>" type="text" name="no" id="no" class="form-control">
        </div>
        <div class="form-group">
          <label for="dur">Date/Duration</label>
          <input value="<?= $person->Duration; ?>" type="text" name="dur" id="dur" class="form-control">
        </div>

        <div class="form-group">
           <label for="prize">Prize  / Rank Obtained</label>
          <input value="<?= $person->Prize; ?>" type="text" name="prize" id="prize" class="form-control">
        </div>
        

         <div class="form-group">
           <label for="remark">Remark</label>
          <input value="<?= $person->Remark; ?>" type="text" name="remark" id="remark" class="form-control">
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
          <button type="submit" class="btn btn-info">Update data</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php

require 'footer.php';}
else{
	if($_SESSION['login_flag'] == 2){
        header("location: ../../../index.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../../../Admin_login.html");
        exit;
    }
    
    
}

?>