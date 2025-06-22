<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
$id = isset($_SESSION['A']) ? $_SESSION['A'] : '';
$message = '';
$sql = 'SELECT * FROM formj WHERE UID=:uid';
$statement = $connection->prepare($sql);
$statement->execute([':uid' => $uid ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['title']) && isset($_POST['publish'])   && isset($_POST['grant1']) && isset($_POST['license'])  && isset($_POST['amount']) && isset($_POST['amount'])   ) {

  $name = $_POST['name'];
  $title = $_POST['title'];
  $publish = $_POST['publish'];
  
 
  $grant1=$_POST['grant1'];
  
  $license=$_POST['license'];
  $amount=$_POST['amount'];
  


   $sql = 'UPDATE formj SET Name=:name,Title=:title,Publish=:publish,Patent_Grant=:grant1,License=:license,Amount=:amount WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name,':title' => $title,':publish' => $publish,':grant1'=>$grant1,':license'=>$license,':amount'=>$amount,':uid' => $uid])) {
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
        <label for="name">Name of the Staff</label>
          <input value="<?= $person->Name; ?>" type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="title">Title of Patent Filed</label>
          <input value="<?= $person->Title; ?>" type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="publish">Patent Published Yes/No (Year)
</label>
          <input value="<?= $person->Publish; ?>" type="text" name="publish" id="publish" class="form-control">
        </div>
        

         <div class="form-group">
         <label for="grant1">Patent Granted Yes/No (Year)
</label>
          <input value="<?= $person->Patent_Grant; ?>" type="text" name="grant1" id="grant1" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="license">Patents Licensed Yes/No (Year)
</label>
          <input value="<?= $person->License; ?>" type="text" name="license" id="license" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="amount">Earning From Patents (Amount in Rupees)</label>
          <input value="<?= $person->Amount; ?>" type="text" name="amount" id="amount" class="form-control">
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