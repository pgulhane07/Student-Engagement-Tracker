<?php
session_start();
require 'db.php';

if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
 $aid = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
 
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>

     <title>Authority Landing Page</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="css/magnific-popup.css">
     <link rel="stylesheet" href="css/font-awesome.min.css">
     <link rel="stylesheet" href="css/utill.css">

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
                    <a href="index.html" class="navbar-brand less_margin">Authority Achievement Tracker</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <?php if($_SESSION['login_flag'] == 2){ ?>
                              <li><a href="Authority_Home.php" class="smoothScroll">Home</a></li>
                              <li><a href="Graphs.php" class="smoothScroll">Graph Analysis</a></li>
                              <li><a href="teacher_profile/view_profile.php" class="smoothScroll">Profile</a></li>
                              <li><a href="students.php" class="smoothScroll">Student</a></li>
                              <li><a href="logout_auth.php" class="smoothScroll">Logout</a></li>
                         <?php } else if($_SESSION['login_flag'] == 3){ ?>
                              <li><a href="Admin_Home.php" class="smoothScroll">Home</a></li>
                              <li><a href="Graphs.php" class="smoothScroll">Graph Analysis</a></li>
                              <li><a href="admin_profile/view_profile.php" class="smoothScroll">Profile</a></li>
                              <li><a href="students.php" class="smoothScroll">Student</a></li>
                              <li><a href="teachers.php" class="smoothScroll">Authority</a></li>
                              <li><a href="logout_admin.php" class="smoothScroll">Logout</a></li>
                         <?php } ?>
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
                              <?php  ?>
                              <h1>Welcome to<br> Teachers Achievements 
                                   <?php
                                   if($_SESSION['Desg'] == 'HOD'){
                                       echo '( '.$_SESSION['Dept'].' Department )';                              
                                  }
                                  ?> </h1>
                                  
                             </h1>
                        </div>
                   </div>

                   
                   
              </div>
         </div>
    </section>
    
    <section id="work" data-stellar-background-ratio="0.5">
     <div class="container">
          <div class="row">

               <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                         <h2>Forms</h2>
                         <span class="line-bar">...</span>
                    </div>
               </div>
          </div>
          <div class="row">
               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 22, 2017</small> -->
                              <h3><a href="teacherforms/FormA/view/index.php">A. Conferences, Seminars, Symposia, Workshops, FDP, STTP Organized /conducted. </a></h3>
                              <!-- <p>You can list your achievement in the art feild here.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->

                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 18, 2017</small> -->
                              <h3><a href="teacherforms/FormB/view/index.php">B. Webinar / video conference /Invited talks organized /conducted.</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 14, 2017</small> -->
                              <h3><a href="teacherforms/FormC/view/index.php">C. Teachers Attended Conferences, Seminars, Symposia, Workshops, FDP, STTP etc.</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormD/view/index.php">D. Collaboration / MoU with National / International Institute/Industry /Research Center/Colleges/University.</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormE/view/index.php">E. Center  of innovation / excellence.</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormF/view/index.php">F. Industry sponsored Labs.</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormG/view/index.php">G. Grants Received</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormH/view/index.php">H. Financial support provided to students. </a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormI/view/index.php">I. Consultancy Projects.</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormJ/view/index.php">J. Patent </a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormK/view/index.php">K. Books / Book Chapter</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormL/view/index.php">L. Research Publications in National and International Journals/Edited Books/Proceedings/Conference</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormM/view/index.php">M. Research Projects/Schemes Undertaken by Teachers</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormN/view/index.php">N. Staff Achievement</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormO/view/index.php">O. Student Achievement</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormP/view/index.php">P. Departmental Achievement</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">


               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormQ/view/index.php">Q. Technical Competitions / Tech Fest Organized / Participated</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormR/view/index.php">R. Industrial Visits / Tours</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>
          </div>
          <div class="row">

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormS/view/index.php">S. Resource Person</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
                         </div>
                    </div>
               </div>

               <div class="col-md-6 col-sm-6">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb1">

                         <div class="media-object media-left">
                              <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                              <h3><a href="teacherforms/FormT/view/index.php">T.Any other information (As applicable )</a></h3>
                              <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                              <!-- <a href="blog-detail.html" class="btn section-btn">Click Here</a> -->
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
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/jquery.stellar.min.js"></script>
     <script src="js/jquery.magnific-popup.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
     <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


</body>
</html>

<?php
}else{
   if($_SESSION['login_flag'] == 2){
       header("location: ../index.html");
       exit;
  }

  else if($_SESSION['login_flag'] == 3){
       header("location: ../Admin_login.php");
       exit;
  }
  
  
}
?>