<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = $_SESSION['AID'];
if (isset ($_POST['name'])  && isset($_POST['title']) && isset($_POST['faculty'])    && isset($_POST['sanction'])  && isset($_POST['fund']) && isset($_POST['DO']) && isset($_POST['DE']) && isset($_POST['amount']) && isset($_POST['major']) ) {
 
  $name = $_POST['name'];
   $faculty = $_POST['faculty'];
   $title = $_POST['title'];
   $sanction = $_POST['sanction'];
   $id = $_POST['ID'];
  $rawdate = $_POST['DO'];
   $rawdate1 = $_POST['DE'];
 
   $fund=$_POST['fund'];
   
 
     
   $amount=$_POST['amount'];
     $ds = date('Y-m-d',strtotime($rawdate));
   $de = date('Y-m-d',strtotime($rawdate1));
   $major=$_POST['major'];
   $uid = uniqid("FM-");
   $sql = 'INSERT INTO formm(UID,ID,Name,Faculty,Title,Sanction,Fund,Date_start,Date_end,Amount,Major) VALUES(:uid,:id,:name,:faculty,:title,:sanction,:fund,:ds,:de,:amount,:major)';
   $statement = $connection->prepare($sql);
   if ($statement->execute([':uid' => $uid,':id' => $id,':name' => $name,':faculty' => $faculty,':title' => $title,':sanction' => $sanction,':fund'=>$fund,':ds'=>$ds,':de'=>$de,':amount'=>$amount,':major'=>$major])) {
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
      <h2>M.  Research Projects/Schemes Undertaken by Teachers
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/FormM/file_entry.php"> -->

      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        
        <div class="form-group">
          <label for="name">Name of the Investigator(s)

</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="faculty">Faculty (Stream)
</label>
          <input type="text" name="faculty" id="faculty" class="form-control">
        </div>
        <div class="form-group">
          <label for="title">Title of the Research Project/Scheme
</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        
         
         <div class="form-group">
          <label for="sanction">Sanctioned order no.& Date</label>
          <input type="text" name="sanction" id="sanction" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="fund">Name of the Funding Agency </label>
          <input type="text" name="fund" id="fund" class="form-control">
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
          <label for="amount">Amount Sanctioned(Rs.)
  </label>
          <input type="text" name="amount" id="amount" class="form-control">
        </div>
    
     <div class="form-group">
          <label for="major">Major/Minor </label>
          <input type="text" name="major" id="major" class="form-control">
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
      else
{
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