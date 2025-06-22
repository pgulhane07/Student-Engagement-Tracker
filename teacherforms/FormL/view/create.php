<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = $_SESSION['AID'];
if (isset ($_POST['name'])  && isset($_POST['title']) && isset($_POST['journal'])    && isset($_POST['level'])  && isset($_POST['volume']) && isset($_POST['page']) && isset($_POST['year']) && isset($_POST['isbn']) && isset($_POST['pub']) ) {
  $name = $_POST['name'];
 $title = $_POST['title'];
 $journal = $_POST['journal'];
 
 $id = $_POST['ID'];
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
      <h2>L.  Research Publications in National and International Journals/Edited Books/Proceedings/Conference
</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <!-- <form method="post" action="/projects/teacherforms/formL/file_entry.php"> -->

      <form method="post" action="create.php">
        <div class="form-group">
          <label for="ID">Reg.ID</label>
          <input type="text" name="ID"  class="form-control">
        </div>
        
        <div class="form-group">
          <label for="name">Name of the Teacher's/Author
</label>
          <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="title">Title of the Paper</label>
          <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
          <label for="journal">Name of the Journal/Proceeding/Edited
Book/Conference
</label>
          <input type="text" name="journal" id="journal" class="form-control">
        </div>
        
         
         <div class="form-group">
          <label for="level">Level (State / National / International)</label>
          <input type="text" name="level" id="level" class="form-control">
        </div>
        
         <div class="form-group">
          <label for="volume">Volume/No / Issue </label>
          <input type="text" name="volume" id="volume" class="form-control">
        </div>

         <div class="form-group">
          <label for="page">Pages </label>
          <input type="text" name="page" id="page" class="form-control">
        </div>
    
     <div class="form-group">
          <label for="year">Year  </label>
          <input type="text" name="year" id="year" class="form-control">
        </div>
    
     <div class="form-group">
          <label for="isbn">ISBN/ISSN No. </label>
          <input type="text" name="isbn" id="isbn" class="form-control">
        </div>
    
     <div class="form-group">
          <label for="pub">Publisher </label>
          <input type="text" name="pub" id="pub" class="form-control">
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