<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
 

if (isset ($_POST['name'])  && isset($_POST['no']) && isset($_POST['dur'])   && isset($_POST['prize']) && isset($_POST['remark']) && isset($_POST['organizer'])  && isset($_POST['DO']) && isset($_POST['DE'])   ) {
  $id = $_POST['ID'];	
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
  $uid = uniqid("FT-");
  $sql = 'INSERT INTO formt(UID,ID,Name,Organizer,Participants,Duration,Prize,Remark,Date_start,Date_end) VALUES(:uid,:id,:name,:organizer,:no,:dur,:prize,:remark,:ds,:de)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':name' => $name,':organizer'=>$organizer,':no' => $no,':dur' => $dur,':prize' => $prize,':remark' => $remark,':ds'=>$ds,':de'=>$de])) {
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
  <a class="navbar-brand" href="index.php">Achievements</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>
T.  Any other information (As applicable )
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      
      <!-- <form method="post" action="/projects/teacherforms/formT/file_entry.php"> -->
      
      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Name of the Activity</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
         <div class="form-group">
          <label for="organizer">Organizer </label>
          <input type="text" name="organizer" id="organizer" class="form-control">
        </div>
        <div class="form-group">
          <label for="no">Name/No. of participants</label>
          <input type="text" name="no" id="no" class="form-control">
        </div>
        <div class="form-group">
          <label for="dur">Date/Duration</label>
          <input type="text" name="dur" id="dur" class="form-control">
        </div>
         <div class="form-group">
          <label for="prize">Prize  / Rank Obtained</label>
          <input type="text" name="prize" id="prize" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="remark">Remark</label>
          <input type="text" name="remark" id="remark" class="form-control">
        </div>
       
        <div class="form-group">
          <label for="DO">Start Date</label>
          <input type="date" name="DO" id="DO" class="form-control">
        </div>
        <div class="form-group">
          <label for="DE">End Date</label>
          <input type="date" name="DE" id="DE" class="form-control">
        </div>
        
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Upload Document Proof</button>
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