<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

 if (isset ($_POST['ID']) && isset ($_POST['activity']) && isset($_POST['title']) && isset($_POST['venue']) && isset($_POST['sponsor'])  && isset($_POST['DO']) && isset($_POST['DE']) && isset($_POST['participant']) && isset($_POST['coordinator']) && isset($_POST['remark']) ) {
  $id = $_POST['ID'];	
  $activity = $_POST['activity'];
  $title = $_POST['title'];
  $venue = $_POST['venue'];
  $sponsor = $_POST['sponsor'];
  $rawdate = $_POST['DO'];
  $rawdate1 = $_POST['DE'];
  $participant=$_POST['participant'];
  $coordinator=$_POST['coordinator'];
  $remark=$_POST['remark'];
  $ds = date('Y-m-d',strtotime($rawdate));
  $de = date('Y-m-d',strtotime($rawdate1));
  $uid = uniqid("FA-");

  $sql = 'INSERT INTO formA(UID,ID,Activity,Title,State,Sponsor,Participants,Coordinator,Remarks,Date_start,Date_end) VALUES(:uid,:id,:activity,:title,:venue,:sponsor,:participant,:coordinator,:remark,:ds,:de)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':activity' => $activity,':title' => $title,':venue' => $venue,':sponsor' => $sponsor, ':participant'=> $participant, ':coordinator'=> $coordinator, ':remark'=> $remark,':ds' => $ds,':de' => $de])) {
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
      <h2>Add Achievement to FormA</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
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
          <label for="venue">State / National / International</label>
          <input type="text" name="venue" id="venue" class="form-control">
        </div>
         <div class="form-group">
          <label for="sponsor">Sponsoring Authority</label>
          <input type="text" name="sponsor" id="sponsor" class="form-control">
        </div>
         
         <div class="form-group">
          <label for="participant">No. of Participants</label>
          <input type="text" name="participant" id="participant" class="form-control">
        </div>
         <div class="form-group">
          <label for="coordinator">Name of the  Coordinator/'s</label>
          <input type="text" placeholder="Add all names seperated by comma" name="coordinator" id="coordinator" class="form-control">
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
          <button type="submit" class="btn btn-info">Create</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php
require 'footer.php';


}else{
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