<?php
session_start();
require 'db.php';

if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
    $aid = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
    
    ?>



    <!DOCTYPE html>
    <html lang="en">
    <head>

     <title>Students</title>

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
                    <ul class="nav navbar-nav navbar-nav-first">
                         <?php if($_SESSION['login_flag'] == 2){ ?>
                              <li><a href="Authority_Home.php" class="smoothScroll">Home</a></li>
                              <li><a href="Graphs.php" class="smoothScroll">Graph Analysis</a></li>
                              <li><a href="teacher_profile/view_profile.php" class="smoothScroll">Profile</a></li>
                              <li><a href="#" class="smoothScroll">Student</a></li>
                              <li><a href="logout_auth.php" class="smoothScroll">Logout</a></li>
                         <?php } else if($_SESSION['login_flag'] == 3){ ?>
                              <li><a href="Admin_Home.php" class="smoothScroll">Home</a></li>
                              <li><a href="Graphs.php" class="smoothScroll">Graph Analysis</a></li>
                              <li><a href="admin_profile/view_profile.php" class="smoothScroll">Profile</a></li>
                              <li><a href="#" class="smoothScroll">Student</a></li>
                              <li><a href="teachers.php" class="smoothScroll">Authority</a></li>
                              <li><a href="logout_admin.php" class="smoothScroll">Logout</a></li>
                         <?php } ?>
                    </ul>

                    <ul class="nav navbar-nav navbar-right"></ul>
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
                              <h1>Welcome to<br> Students Achievements 
                                   <?php
                                   if($_SESSION['Desg'] == 'HOD'){
                                    echo '( '.$_SESSION['Dept'].' Department )';
                               }else if($_SESSION['Desg'] == 'Class Teacher'){
                                    echo '( '.substr($_SESSION['CID'], 0,3).' Class )';                              
                               } ?></h1>
                          </div>
                     </div>

                     
                     
                </div>
           </div>
      </section>

      <!-- BLOG -->
      <section id="work" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title">
                              <h2>Sections of achievement</h2>
                              <span class="line-bar">...</span>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- BLOG THUMB -->
                         <div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="arts_view/index.php"><img src="images/art_image.jpg" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <!-- <small><i class="fa fa-clock-o"></i> December 22, 2017</small> -->
                                   <h3><a href="arts_view/index.php">Art.</a></h3>
                                   <!-- <p>You can list your achievement in the art feild here.</p> -->
                                   <a href="arts_view/index.php" class="btn section-btn">Click Here</a>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- BLOG THUMB -->
                         <div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="comp_view/index.php"><img src="images/coding_image.jpg" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <!-- <small><i class="fa fa-clock-o"></i> December 18, 2017</small> -->
                                   <h3><a href="comp_view/index.php">Competitive Coding.</a></h3>
                                   <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                                   <a href="comp_view/index.php" class="btn section-btn">Click Here</a>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- BLOG THUMB -->
                         <div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="internship_view/index.php"><img src="images/internship_image.jpg" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <!-- <small><i class="fa fa-clock-o"></i> December 14, 2017</small> -->
                                   <h3><a href="internship_view/index.php">Internships</a></h3>
                                   <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                                   <a href="internship_view/index.php" class="btn section-btn">Click Here</a>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- BLOG THUMB -->
                         <div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="paper_view/index.php"><img src="images/presentation_image.jpg" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                                   <h3><a href="paper_view/index.php">Paper presentation</a></h3>
                                   <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                                   <a href="paper_view/index.php" class="btn section-btn">Click Here</a>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- BLOG THUMB -->
                         <div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="project_competition_view/index.php"><img src="images/project_competition_image.jpg" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                                   <h3><a href="project_competition_view/index.php">Project Competition</a></h3>
                                   <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                                   <a href="project_competition_view/index.php" class="btn section-btn">Click Here</a>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- BLOG THUMB -->
                         <div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="social_view/index.php"><img src="images/social_work_image.jpg" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                                   <h3><a href="social_view/index.php">Social work</a></h3>
                                   <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                                   <a href="social_view/index.php" class="btn section-btn">Click Here</a>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                         <!-- BLOG THUMB -->
                         <div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="sports_view/index.php"><img src="images/sports_image.jpg" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <!-- <small><i class="fa fa-clock-o"></i> December 10, 2017</small> -->
                                   <h3><a href="sports_view/index.php">Sports</a></h3>
                                   <!-- <p>Lorem ipsum dolor sit consectetur adipiscing morbi venenatis.</p> -->
                                   <a href="sports_view/index.php" class="btn section-btn">Click Here</a>
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


     <!-- MODAL -->
     <section class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
               <div class="modal-content modal-popup">

                    <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>

                    <div class="modal-body">
                         <div class="container-fluid">
                              <div class="row">

                                   <div class="col-md-12 col-sm-12">
                                        <div class="modal-title">
                                             <h2>Hydro Co</h2>
                                        </div>

                                        <!-- NAV TABS -->
                                        <ul class="nav nav-tabs" role="tablist">
                                             <li class="active"><a href="#sign_up" aria-controls="sign_up" role="tab" data-toggle="tab">Create an account</a></li>
                                             <li><a href="#sign_in" aria-controls="sign_in" role="tab" data-toggle="tab">Sign In</a></li>
                                        </ul>

                                        <!-- TAB PANES -->
                                        <div class="tab-content">
                                             <div role="tabpanel" class="tab-pane fade in active" id="sign_up">
                                                  <form action="#" method="post">
                                                       <input type="text" class="form-control" name="name" placeholder="Name" required>
                                                       <input type="telephone" class="form-control" name="telephone" placeholder="Telephone" required>
                                                       <input type="email" class="form-control" name="email" placeholder="Email" required>
                                                       <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                       <input type="submit" class="form-control" name="submit" value="Submit Button">
                                                  </form>
                                             </div>

                                             <div role="tabpanel" class="tab-pane fade in" id="sign_in">
                                                  <form action="#" method="post">
                                                       <input type="email" class="form-control" name="email" placeholder="Email" required>
                                                       <input type="password" class="form-control" name="password" placeholder="Password" required>
                                                       <input type="submit" class="form-control" name="submit" value="Submit Button">
                                                       <a href="https://www.facebook.com/templatemo">Forgot your password?</a>
                                                  </form>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                         </div>
                    </div>

               </div>
          </div>
     </section>

     <!-- SCRIPTS -->
     <!-- SCRIPTS -->
     <script type="text/javascript">
        var slideIndex = 0;
        carousel();
        
        function carousel() {
             var i;
             var x = document.getElementsByClassName("mySlides");
             for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
           }
           slideIndex++;
           if (slideIndex > x.length) {slideIndex = 1}
             x[slideIndex-1].style.display = "block";
      setTimeout(carousel, 3000); // Change image every 2 seconds
 }
</script>s
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/custom.js"></script>

</body>
</html>

<?php
}else{
  if($_SESSION['login_flag'] == 2){
   header("location: ../index.html");
   exit;
}

else if($_SESSION['login_flag'] == 3){
   header("location: ../Admin_login.html");
   exit;
}


}
?>