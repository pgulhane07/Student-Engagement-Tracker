<?php
session_start();
require '../db.php';
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
    header("location: ../Admin_login.html");
    exit;
}

  $cls = isset($_SESSION['cls']) ? $_SESSION['cls'] : '' ;
  $bct = isset($_SESSION['bct']) ? $_SESSION['bct'] : '' ;
  $message = '';
  $sql = 'SELECT * FROM mentor WHERE Class = :cls AND Batch = :bct';
  $statement = $connection->prepare($sql);
  $statement->execute([':cls' => $cls,  ':bct' => $bct]);
  $person = $statement->fetch(PDO::FETCH_OBJ);
  if(isset ($_POST['Class'])  && isset($_POST['Batch'])){
    $c = $_POST['Class'];
    $b = $_POST['Batch'];
    $sql1 = 'UPDATE mentor SET Class=:c, Batch=:b WHERE Class = :cls AND Batch = :bct';
    echo $sql1;
    $statement1 = $connection->prepare($sql1);
    if ($statement1->execute([':c' => $c, ':b' => $b, ':cls' => $cls, ':bct' => $bct])){
       header("Location: view.php");
    }

  }else{
     $message = 'data updation Unsuccessful';
  }




         
 ?>

<html lang="en">
  <head>
    <title>Edit Mentor Batch</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="../Admin_Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="view.php">Mentor Batches</a>
      </li>    
      
    </ul>
  </div>
    
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Edit <?php echo $bct;?> Batch</h2>
    </div>
    <div class="card-body" style="overflow: scroll;">
      <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form action='edit.php' method="post">        
        <div class="form-group">
          <label for="Class">Class</label>
          <input value="<?= $person->Class; ?>" type="text" name="Class" class="form-control">
        </div>
        <div class="form-group">
          <label for="Batch">Batch</label>
          <input value="<?= $person->Batch; ?>" type="text" name="Batch" class="form-control">
        </div>
        
        <div class="form-group">
          <button type="submit" class="btn btn-info">Edit Batch</button>
        </div>
      </form>        
           
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
</body>
</html>
