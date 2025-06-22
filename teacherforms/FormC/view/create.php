<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
  if (isset($_POST['title']) && isset($_POST['type']) && isset($_POST['organiser'])   && isset($_POST['DO']) && isset($_POST['DE'])&& isset($_POST['staff'])  && isset($_POST['sponsorship']) ) {
    $id = $_POST['ID'];	
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
      <h2>Teachers Attended Conferences, Seminars, Symposia, Workshops, FDP, STTP etc.
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/FormC/file_entry.php"> -->
      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
       
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>

         <div class="form-group">
          <label for="type">Type/Nature</label>
          <input type="text" name="type" id="type" class="form-control">
        </div>

        <div class="form-group">
          <label for="organiser">Name of organizer</label>
          <input type="text" name="organiser" id="organiser" class="form-control">
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
          <label for="staff">Name of the Staff</label>
          <input type="text" name="staff" id="staff" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="sponsorship">Sponsorship Details</label>
          <input type="text" name="sponsorship" id="sponsorship" class="form-control">
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