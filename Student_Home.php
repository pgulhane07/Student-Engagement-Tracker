<?php
require 'config.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  header("location: Student_login.html");
  exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';

$sql = "SELECT * from student WHERE ID ='$id'";
$result = mysqli_query ($conn,$sql) or die ('Error');

if($result){
 $row = mysqli_fetch_array ($result);
 $name = $row ['Full_Name'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>

 <title>Student Landing Page</title>

 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=Edge">
 <meta name="description" content="">
 <meta name="keywords" content="">
 <meta name="author" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 <link rel="stylesheet" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="css/magnific-popup.css">
 <link rel="stylesheet" href="css/font-awesome.min.css">

 <!-- MAIN CSS -->
 <link rel="stylesheet" href="css/templatemo-style.css">
</head>
<body>

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
   <a href="index.html" class="navbar-brand">Student Achievement Tracker</a>
 </div>

 <!-- MENU LINKS -->
 <div class="collapse navbar-collapse">
  <ul class="nav navbar-nav navbar-nav-first navbar-right" >
   <li><a href="stu_profile/view_profile.php" class="smoothScroll">Profile</a></li>
   <li><a href="#contact" class="smoothScroll">About us</a></li>
   <li><a href="#contact" class="smoothScroll">Help</a></li>
   <li><a href="logout_stu.php" class="smoothScroll">Logout</a></li>
 </ul>
</div>

</div>
</section>


<!-- HOME -->
<section id="home" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
   <div class="row">

    <div class="col col-sm-12">
     <div class="home-info">
      <h1>Welcome <?php echo $name; ?></h1>
    </div>
  </div>

  
  
</div>
</div>
</section>


<!-- ABOUT -->
<section id="work" data-stellar-background-ratio="0.5">
  <div class="container">
   <div class="row">

    <div class="col-md-12 col-sm-12">
     <div class="col head1">
       <div class="section-title">
        <div class="section-title">
         <h2>Achievements</h2>
         <span class="line-bar">...</span>
       </div>
     </div>
   </div>
 </div>
</div>
<div class="row">
  <div class="col-md-12 col-sm-12">
   <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">2019-20</th>
        <th scope="col">2020-21</th>
        <th scope="col">2021-22</th>
        <th scope="col">2022-23</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">Art</th>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
      </tr>
      <tr>
        <th scope="row">Competitive Coding</th>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
      </tr>
      <tr>
        <th scope="row">Internships</th>
        <td>0</td>
        <td>0</td>
        <td>0</td>
        <td>0</td>
      </tr>
      <tr>
       <th scope="row">Paper Presentation</th>
       <td>0</td>
       <td>0</td>
       <td>0</td>
       <td>0</td>
     </tr>
     <tr>
       <th scope="row">Project Completion</th>
       <td>0</td>
       <td>0</td>
       <td>0</td>
       <td>0</td>
     </tr>
     <tr>
       <th scope="row">Socail Work</th>
       <td>0</td>
       <td>0</td>
       <td>0</td>
       <td>0</td>
     </tr>
     <tr>
       <th scope="row">Sports</th>
       <td>0</td>
       <td>0</td>
       <td>0</td>
       <td>0</td>
     </tr>
   </tbody>
 </table>
</div>
</div>
</div>
</section>


<!-- BLOG -->
<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <div class="row">

    <div class="col-md-12 col-sm-12">
     <div class="section-title">
      <h2>Sections of achievement</h2>
      <span class="line-bar">...</span>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-sm-6">
   <!-- BLOG THUMB -->
   <div class="media blog-thumb">
    <div class="media-object media-left">
     <a href="arts/index.php"><img src="images/art_image.jpg" class="img-responsive" alt=""></a>
   </div>
   <div class="media-body blog-info">
     <h3><a href="arts/index.php">Art.</a></h3>
     <a href="arts/index.php" class="btn section-btn">Click Here</a>
   </div>
 </div>
</div>


<div class="col-md-6 col-sm-6">
 <!-- BLOG THUMB -->
 <div class="media blog-thumb">
  <div class="media-object media-left">
   <a href="comp/index.php"><img src="images/coding_image.jpg" class="img-responsive" alt=""></a>
 </div>
 <div class="media-body blog-info">                                   
   <h3><a href="comp/index.php">Competitive Coding.</a></h3>
   <a href="comp/index.php" class="btn section-btn">Click Here</a>
 </div>
</div>
</div>
</div>
<div class="row">

  <div class="col-md-6 col-sm-6">
   <!-- BLOG THUMB -->
   <div class="media blog-thumb">
    <div class="media-object media-left">
     <a href="internship/index.php"><img src="images/internship_image.jpg" class="img-responsive" alt=""></a>
   </div>
   <div class="media-body blog-info">                              
     <h3><a href="internship/index.php">Internships</a></h3>                                  
     <a href="internship/index.php" class="btn section-btn">Click Here</a>
   </div>
 </div>
</div>

<div class="col-md-6 col-sm-6">
 <!-- BLOG THUMB -->
 <div class="media blog-thumb">
  <div class="media-object media-left">
   <a href="paper/index.php"><img src="images/presentation_image.jpg" class="img-responsive" alt=""></a>
 </div>
 <div class="media-body blog-info">                                   
   <h3><a href="paper/index.php">Paper presentation</a></h3>                                 
   <a href="paper/index.php" class="btn section-btn">Click Here</a>
 </div>
</div>
</div>
</div>
<div class="row">

  <div class="col-md-6 col-sm-6">
   <!-- BLOG THUMB -->
   <div class="media blog-thumb">
    <div class="media-object media-left">
     <a href="project/index.php"><img src="images/project_competition_image.jpg" class="img-responsive" alt=""></a>
   </div>
   <div class="media-body blog-info">
     
     <h3><a href="project/index.php">Project Competition</a></h3>
     
     <a href="project/index.php" class="btn section-btn">Click Here</a>
   </div>
 </div>
</div>

<div class="col-md-6 col-sm-6">
 <!-- BLOG THUMB -->
 <div class="media blog-thumb">
  <div class="media-object media-left">
   <a href="social/index.php"><img src="images/social_work_image.jpg" class="img-responsive" alt=""></a>
 </div>
 <div class="media-body blog-info">                                   
   <h3><a href="social/index.php">Social work</a></h3>
   <a href="social/index.php" class="btn section-btn">Click Here</a>
 </div>
</div>
</div>
</div>
<div class="row">

  <div class="col-md-6 col-sm-6">
   <!-- BLOG THUMB -->
   <div class="media blog-thumb">
    <div class="media-object media-left">
     <a href="sports/index.php"><img src="images/sports_image.jpg" class="img-responsive" alt=""></a>
   </div>
   <div class="media-body blog-info">
     <h3><a href="sports/index.php">Sports</a></h3>
     <a href="sports/index.php" class="btn section-btn">Click Here</a>
   </div>
 </div>
</div>

</div>
</div>
</section>

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
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/custom.js"></script>

</body>
</html>