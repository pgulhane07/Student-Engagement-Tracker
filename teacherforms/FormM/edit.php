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
$sql = 'SELECT * FROM formm WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['title']) && isset($_POST['faculty'])    && isset($_POST['sanction'])  && isset($_POST['fund']) && isset($_POST['DO']) && isset($_POST['DE']) && isset($_POST['amount']) && isset($_POST['major'])  ) {
  
  $name = $_POST['name'];
  $faculty = $_POST['faculty'];
  $title = $_POST['title'];
  $sanction = $_POST['sanction'];
  
 
  $fund=$_POST['fund'];
  
$rawdate = $_POST['DO'];
  $rawdate1 = $_POST['DE'];    
  $amount=$_POST['amount'];
  
  $major=$_POST['major'];
  
 $ds = date('Y-m-d',strtotime($rawdate));
  $de = date('Y-m-d',strtotime($rawdate1));


   $sql = 'UPDATE formm SET Name=:name,Faculty=:faculty,Title=:title,Sanction=:sanction,Fund=:fund,Date_start=:ds,Date_end=:de,Amount=:amount,Major=:major WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name,':faculty' => $faculty,':title' => $title,':sanction' => $sanction,':fund'=>$fund,':ds' => $ds,':de' => $de,':amount'=>$amount,':major'=>$major,':uid' => $uid])) {
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
           <label for="name">Name of the Investigator(s)
</label>
          <input value="<?= $person->Name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
         <div class="form-group">
         <label for="faculty">Faculty (Stream)
</label>
          <input value="<?= $person->Faculty; ?>" type="text" name="faculty" id="faculty" class="form-control">
        </div>
        <div class="form-group">
          <label for="title">Title of the Research Project/Scheme</label>
          <input value="<?= $person->Title; ?>" type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
         <label for="sanction">Sanctioned order no.& Date</label>
          <input value="<?= $person->Sanction; ?>" type="text" name="sanction" id="sanction" class="form-control">
        </div>
        
        
         <div class="form-group">
          <label for="fund">Name of the Funding Agency </label>
          <input value="<?= $person->Fund; ?>" type="text" name="fund" id="fund" class="form-control">
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
              <label for="amount">Amount Sanctioned(Rs.)
  </label>
          <input value="<?= $person->Amount; ?>" type="text" name="amount" id="amount" class="form-control">
        </div>

         <div class="form-group">
          <label for="major">Major/Minor </label>
          <input value="<?= $person->Major; ?>" type="text" name="major" id="major" class="form-control">
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