<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header("location: ../../admin_login.php");
  exit;
}


$id = isset($_SESSION['ADID']) ? $_SESSION['ADID'] : '';
$sql = 'SELECT * FROM stu_temp';
$statement = $connection->prepare($sql);
$statement->execute();
$people = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<html lang="en">
<head>

 <title>Professor Profile</title>

 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=Edge">
 <meta name="description" content="">
 <meta name="keywords" content="">
 <meta name="author" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 <link rel="stylesheet" href="../css/bootstrap.min.css">
 <link rel="stylesheet" href="../css/magnific-popup.css">
 <link rel="stylesheet" href="../css/font-awesome.min.css">

 <!-- MAIN CSS -->
 <link rel="stylesheet" href="../css/templatemo-style.css">
 <link rel="stylesheet" href="../css/ProfileStyle.css">
 <link rel="preconnect" href="https://fonts.gstatic.com">
 <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body class="bg-info">
 <div class="new-section">
   <!-- PRE LOADER -->
   <section class="preloader">
    <div class="spinner">
     <span class="spinner-rotate"></span>
   </div>
 </section> 


 <!-- MENU -->
 <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
  <div class="container">

   <div class="navbar-header">
    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
     <span class="icon icon-bar"></span>
     <span class="icon icon-bar"></span>
     <span class="icon icon-bar"></span>
   </button>

   <!-- lOGO TEXT HERE -->
   <a href="index.html" class="navbar-brand">Achievement Tracker</a>
 </div>

 <!-- MENU LINKS -->
 <div class="collapse navbar-collapse navbar-right">
  <ul class="nav navbar-nav navbar-nav-first">         
    <li><a href="../Admin_Home.php" class="smoothScroll">Home</a></li>
    <li><a href="../Graphs.php" class="smoothScroll">Graph Analysis</a></li>
    <li><a href="../admin_profile/view_profile.php" class="smoothScroll">Profile</a></li>
    <li><a href="../students.php" class="smoothScroll">Student</a></li>
    <li><a href="../teachers.php" class="smoothScroll">Authority</a></li>
    <li><a href="../logout_admin.php" class="smoothScroll">Logout</a></li>
  </ul>

  <ul class="nav navbar-nav navbar-right"></ul>
</div>

</div>
</section>
<section id="section1">
  <div class="top-space">
   <h1>Student Registration</h1>
 </div>
</section>

<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <div class="row">

    <div class="col-md-12 col-sm-12">
      <table class="table   ">
        <thead>
          <tr>
            <th scope="col">Sr. No.</th>
            <th scope="col">Reg.ID</th>
            <th scope="col">Full Name</th>
            <th scope="col">Class</th>
            <th scope="col">Roll No</th>
            <th scope="col">Year</th>
            <th scope="col">Department</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody style="text-align: left;">
          <?php $cnt=0;
          foreach($people as $person): 
            $cnt++;
            
            ?>
            <tr>
             <th scope="row"><?php echo $cnt?></th>
             <td scope="row"><?= $person->ID; ?></td>
             <td scope="row"><?= $person->Full_Name; ?></td>
             <td scope="row"><?= $person->Class; ?></td>
             <td scope="row"><?= $person->Rollno; ?></td>
             <td scope="row"><?= $person->Year; ?></td>
             <td scope="row"><?= $person->Department; ?></td>
             <td scope="row"><?= $person->DOB; ?></td>
             <td scope="row"><?= $person->Email; ?></td>
             <td scope="row"><?= $person->Mobile; ?></td>
             <td scope="row">
              <form action='push.php' method='post'>
                <input type='hidden' name='id1' value='<?php echo $person->ID;?>' />
                <button class="btn btn-info" onClick='submit();'>Allow</button>
              </form>
              <form action='delete.php' method='post'>
                <input type='hidden' name='id2' value='<?php echo $person->ID;?>' />
                <button type="submit" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this entry?')">Delete</button>
                
              </form>
            </td>                    
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</section>


<!-- FOOTER -->
<footer data-stellar-background-ratio="0.5">
  <div class="container">
   <div class="row">

    <div class="col-md-5 col-sm-12">
     <div class="footer-thumb footer-info"> 
      <h2>Achievement Tracker</h2>
      <p>This webiste belongs to PICT. For use of only PICT staff and students.</p>
    </div>
  </div>

  <div class="col-md-2 col-sm-4"> 
   <div class="footer-thumb"> 
    <h2>Explore</h2>
    <ul class="footer-link">
     <li><a href="#">Home</a></li>
     <li><a href="#">About</a></li>
     <li><a href="#">Contact</a></li>
     <li><a href="#">Help</a></li>
     
   </ul>
 </div>
</div>

<div class="col-md-2 col-sm-4"> 
 <div class="footer-thumb"> 
  <h2>Follow</h2>
  <ul class="footer-link">
   <li><a href="#">LinkedIn</a></li>
   <li><a href="#">Facebook</a></li>
   
 </ul>
</div>
</div>

<div class="col-md-3 col-sm-4"> 
 <div class="footer-thumb"> 
  <h2>Find us</h2>
  <ul class="footer-link">
   <li><a href="https://goo.gl/maps/fyEnpoCLrjbJpiUEA" target="_blank">Pune Institute of Computer Technology,<br>Sector No. 27, <br> Dhankawadi, Pune-411043</a></li>
   
   
 </ul>
 
</div>
</div>                    

<div class="col-md-12 col-sm-12">
 <div class="footer-bottom">
  <div class="col-md-12 col-sm-9">
   <div class="copyright-text"> 
    <p>Copyright &copy; 2021 @PICT.EDU</p>
  </div>
</div>

</div>
</div>

</div>
</div>
</footer>

<!-- SCRIPTS -->
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.stellar.min.js"></script>
<script src="../js/jquery.magnific-popup.min.js"></script>
<script src="../js/smoothscroll.js"></script>
<script src="../js/custom.js"></script>
<script src="../js/photo.js"></script>
</script>
</body>
</html>















