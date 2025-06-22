<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../index.html");
    exit;
}
$_SESSION['type']='Internship';
$_SESSION['flag_file']=1;
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$message = '';
$uid = uniqid("INT-");
$filename='';

if (isset ($_POST['Company']) && isset($_POST['Address']) && isset($_POST['Description']) && isset($_POST['Type'])&& isset($_POST['Job_Role']) && isset($_POST['Source']) 
            && isset($_POST['Stipend']) && isset($_POST['Approve']) && isset($_POST['Duration']) && isset($_POST['Date_Join']) && isset($_POST['Date_End'])) 
            {
  $Com = $_POST['Company'];
  $descp = $_POST['Description'];
  $job_role = $_POST['Job_Role'];
  $type = $_POST['Type'];
  $Stipend = $_POST['Stipend'];
  $duration = $_POST['Duration'];
  $rawdata= $_POST['Date_Join'];
  $rawend=$_POST['Date_End'];
  $source=$_POST['Source'];
  $approve=$_POST['Approve'];
  $address=$_POST['Address'];
  $doj = date('Y-m-d',strtotime($rawdata));
  $doe=date('Y-m-d',strtotime($rawend));
  $class = '';
    $sql1 = "SELECT ClassID FROM student WHERE ID = '$id'";
    $result1 = mysqli_query ($conn,$sql1) or die ('Error');
    if(mysqli_num_rows($result1)!=0)
    {
      $row = mysqli_fetch_array ($result1);
      $class = $row ['ClassID'];
    }

  $sql = 'INSERT INTO internship(UID,ID,ClassIDCompany,Address,Duration,Type,Description,Job_Role,Stipend,Source,Approve,Date_Join,Date_End) VALUES(:uid,:id,:cid,:Com,:address,:duration,:type,:descp,:job_role,:Stipend,
                                :source,:approve,:doj,:doe)';

  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':cid' => $class,':Com' => $Com,':address' => $address,':duration' => $duration,':type' => $type,':descp' => $descp,':job_role'=> $job_role,':Stipend'=> $Stipend,':source' => $source,':approve' => $approve,':doj' => $doj,':doe' => $doe])) {
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
        <a class="nav-link" href="">Add Data</a>
      </li>
      
    </ul>
  </div>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Add Certificate</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
     
       <form  action="../file/filesLogic.php?uid=<?php echo $uid?>" method="post" enctype="multipart/form-data" > 
                  <input type="file" name="myfile" id="file" >
                   <button style="margin:5%;" type="submit" name="save" class="btn btn-info">Submit</button>
                </form> 
             
             
      </form>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>