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
$sql = 'SELECT * FROM formk WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset ($_POST['name'])  && isset($_POST['title']) && isset($_POST['pub'])   && isset($_POST['DO']) && isset($_POST['copy'])  && isset($_POST['isbn']) ) {
  $name = $_POST['name'];
  $title = $_POST['title'];
  $pub = $_POST['pub'];
  
  $rawdate = $_POST['DO'];
  $copy=$_POST['copy'];
  $link=$_POST['link'];
  
  $isbn=$_POST['isbn'];
  $dob = date('Y-m-d',strtotime($rawdate));


   $sql = 'UPDATE formk SET Name=:name,Title=:title,Publisher=:pub,Date_start=:dob,Copy=:copy,Link=:link,Isbn=:isbn WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name,':title' => $title,':pub' => $pub,':dob' => $dob,':copy'=>$copy,':link'=>$link,':isbn'=>$isbn,':uid' => $uid])) {
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
          <label for="name">Name of the Teacher(s)/Author</label>
          <input value="<?= $person->Name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
         <label for="title">Title of the Reference Books/Monographs</label>
          <input value="<?= $person->Title; ?>" type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
           <label for="pub">Name and Place of Publisher(s)</label>
          <input value="<?= $person->Publisher; ?>" type="text" name="pub" id="pub" class="form-control">
        </div>
        
         <div class="form-group">
           <label for="DO">Date of Publication</label>
          <input value="<?= $person->Date_start; ?>" type="date" name="DO" id="DO" class="form-control">
        </div>
         <div class="form-group">
          <label for="copy">Hard /Soft Copy</label>
          <input value="<?= $person->Copy; ?>" type="text" name="copy" id="copy" class="form-control">
        </div>
        
         <div class="form-group">
           <label for="link">Link in case of Soft copy</label>
          <input value="<?= $person->Link; ?>" type="text" name="link" id="link" class="form-control">
        </div>
         <div class="form-group">
            <label for="isbn">Isbn/Issn No.</label>
          <input value="<?= $person->Isbn; ?>" type="text" name="isbn" id="isbn" class="form-control">
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