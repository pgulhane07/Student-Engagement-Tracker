<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
  if (isset ($_POST['activity'])  && isset($_POST['title']) && isset($_POST['speaker'])   && isset($_POST['DO']) && isset($_POST['DE']) && isset($_POST['participant'])  && isset($_POST['remark']) ) {
    $id = $_POST['ID'];	
    $activity = $_POST['activity'];
    $title = $_POST['title'];
    $speaker = $_POST['speaker'];
    $rawdate = $_POST['DO'];
     $rawdate1 = $_POST['DE'];
    $participant=$_POST['participant'];
   
    $remark=$_POST['remark'];
   $ds = date('Y-m-d',strtotime($rawdate));
    $de = date('Y-m-d',strtotime($rawdate1));
    $uid = uniqid("FB-");
    $sql = 'INSERT INTO formb(UID,ID,Activity,Title,Speaker,Participants,Remarks ,Date_start,Date_end) VALUES(:uid,:id,:activity,:title,:speaker,:participant,:remark,:ds,:de)';
    $statement = $connection->prepare($sql);
    if ($statement->execute([':uid' => $uid,':id' => $id,':activity' => $activity,':title' => $title,':speaker' => $speaker,':participant'=>$participant,':remark'=>$remark,':ds'=>$ds,':de'=>$de])) {
      $message = 'data inserted successfully';
    }
    
  }
  else{
      $message = 'data insertion Unsuccessful';
    }
// $id = $_SESSION['AID'];

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
      <h2>Webinar / video conference /Invited talks organized /conducted.
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/FormB/file_entry.php"> -->
      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        <div class="form-group">
          <label for="activity">Activity/Event</label>
          <input type="text" name="activity" id="activity" class="form-control">
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="speaker">Speaker/Resource Person</label>
          <input type="text" name="speaker" id="speaker" class="form-control">
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
          <label for="participant">No. of Participants</label>
          <input type="text" name="participant" id="participant" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="remark">Remark</label>
          <input type="text" name="remark" id="remark" class="form-control">
        </div>
    

        <div class="form-group">
          <button type="submit" class="btn btn-info">Upload Document Proof</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
require 'footer.php';
      }
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