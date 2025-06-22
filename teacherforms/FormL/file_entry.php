<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../../index.html");
    exit;
}
$id = $_SESSION['AID'];
$_SESSION['type'] = 'formL';
$_SESSION['flag_file'] = 2; 

$filename='';

if (isset ($_POST['name'])  && isset($_POST['title']) && isset($_POST['journal'])    && isset($_POST['level'])  && isset($_POST['volume']) && isset($_POST['page']) && isset($_POST['year']) && isset($_POST['isbn']) && isset($_POST['pub']) ) {
   $name = $_POST['name'];
  $title = $_POST['title'];
  $journal = $_POST['journal'];
  
 
  $level=$_POST['level'];
  
  $volume=$_POST['volume'];
    $currdate=date("Y-m-d");

  $page=$_POST['page'];
  
  $year=$_POST['year'];
  
  $isbn=$_POST['isbn'];
  
  $pub=$_POST['pub'];

  $uid = uniqid("FL-");
  $sql = 'INSERT INTO forml(UID,ID,Name,Title,Journal,Level,Volume,Page,Year,Isbn,Publisher,Date_start) VALUES(:uid,:id,:name,:title,:journal,:level,:volume,:page,:year,:isbn,:pub,:ds)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':uid' => $uid,':id' => $id,':name' => $name,':title' => $title,':journal' => $journal,':level'=>$level,':volume'=>$volume,':page'=>$page,':year'=>$year,':isbn'=>$isbn,':pub'=>$pub,':ds'=>$currdate])) {
    $message = 'data inserted successfully';
  }
  
}
else{
    $message = 'data insertion Unsuccessful';
  }

// Uploads files

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
        <a class="nav-link" href="">Add Data</a>
      </li>
      
    </ul>
  </div>
  
</nav>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>L.  Research Publications in National and International Journals/Edited Books/Proceedings/Conference</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
     
    <form  action="../../file/filesLogic.php?uid=<?php echo $uid?>&type=formL&flag_file=2" method="post" enctype="multipart/form-data" > 
                  <input type="file" name="myfile" id="file" >
                   <button style="margin:5%;" type="submit" name="save" class="btn btn-info">Submit</button>
        </form> 
             

        
      </form>
    </div>
  </div>
</div>

<?php

require 'footer.php';
      
?>