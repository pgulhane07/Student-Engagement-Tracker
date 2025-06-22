<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../index.html");
    exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : '';
 //$uid = $_GET['uid'];
$message = '';


$sql = 'SELECT * FROM project_competition WHERE ID=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['Title'])  && isset ($_POST['Domain'])  && isset ($_POST['Type'])  && isset($_POST['Description']) && isset ($_POST['Guide']) && isset ($_POST['Sponsor'])  && isset($_POST['Venue']) && isset($_POST['Achievements'])  && isset($_POST['DOB'])) {
  $title =$_POST['Title'];
  $domain =$_POST['Domain'];
  $guide =$_POST['Guide'];
  if($_POST['Sponsor'] == 'Not Sponsored'){
    $sponsor = 'No';
  }else{
    $sponsor = isset($_POST['company']) ? $_POST['company'] : 'No';
  } 
  $type = $_POST['Type'];
  $descp = $_POST['Description'];
  $venue = $_POST['Venue'];
  $achieve = $_POST['Achievements'];
  $rawdate = $_POST['DOB'];
  $dob = date('Y-m-d',strtotime($rawdate));
  
  $sql = 'UPDATE project_competition SET Title=:title,Domain=:domain,Type=:type,Description=:descp,Guide=:guide,Sponsor=:sponsor,Venue=:venue,Achievement=:achieve,Date_Proj=:dob WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':title' => $title,':domain' => $domain,':type' => $type,':descp' => $descp,':guide' => $guide,':sponsor' => $sponsor,':venue' => $venue,':achieve' => $achieve,':dob' => $dob,':uid' => $uid])) {
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
  <a class="navbar-brand" href="../Student_Home.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Achievements</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Add Achievements</a>
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
          <label for="Title">Title</label>
          <input value="<?= $person->Title; ?>" type="text" name="Title"  class="form-control" required>
        </div>

        <div class="form-group">
        <label for="Domain">Domain</label>
        <input value="<?= $person->Domain; ?>" type="text" name="Domain" class="form-control" required>  
        </div>

        <div class="form-group">
          <label for="Type">Type of Project</label>
            <div class="col-lg-6 radio">
                <label>
                    <input type="radio" name="Type" value="Software" required/>Software
                </label>
            </div>
            <div class=" col-lg-6 radio">
                <label>
                    <input type="radio" name="Type" value="Hardware" required/>Hardware
                </label>
            </div>          
        </div>

        <div class="form-group">
          <label for="Description">Description (Max 50 words)</label>
          <textarea  value="<?= $person->Description; ?>" name="Description" style="width: 100%; height: 100%" required>
          </textarea>
        </div>

        <div class="form-group">
          <label for="Guide">Name of Guide</label>
          <input value="<?= $person->Guide; ?>" type="text" name="Guide" class="form-control" required>
        </div>

        <div class=" form-group">
          <label class="control-label">Project Sponsored/Not Sponsored</label>
          <div class=" col-lg-6 input-group">
            <select name="Sponsor" class="form-control selectpicker" onchange="myFunction1(this)">
              <?php if($person->Sponsor != 'No' ){ ?>
                <option value="Sponsored">Sponsored</option>
                <option value="Not Sponsored">Not Sponsored</option>
              <?php }else{?>  
                <option value="Not Sponsored">Not Sponsored</option>
                <option value="Sponsored">Sponsored</option>
              <?php } ?>  
            </select>
          </div>
          <div id="company" class="form-group">
              <label class="  control-label" style="margin-top: 2%;">Company Name</label>     
                <div class=" col-lg-6 input-group">
                  <input id="company" value="<?= $person->Sponsor ?>" name="company" placeholder="Company Name" class="form-control" type="text">
                </div>
          </div>
        </div>  

        <div class="form-group">
          <label for="Achievements">Achievements</label>
          <input value="<?= $person->Achievement; ?>" type="text" name="Achievements"  class="form-control" required>
        </div>

        <div class="form-group">
          <label for="Venue">Venue</label>
          <input value="<?= $person->Venue; ?>" type="text" name="Venue"  class="form-control" required>
        </div>

         <div class="form-group">
          <label for="DOB">Date of Occasion</label>
          <input value="<?= $person->Date_Proj; ?>" type="date" name="DOB" class="form-control" required>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Update Achievement</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
<script type="text/javascript">
   function myFunction1(company) {
        var company1 = company.value;
        if (company1 == 'Sponsored') {
            document.getElementById("company").style.display = "block";
        }
        else {
            document.getElementById("company").style.display = "none";
        }
    }
</script>