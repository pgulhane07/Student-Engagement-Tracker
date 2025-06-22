<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true ||  isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$sql = "SELECT * FROM authority WHERE ID='$id'";
$result = mysqli_query ($conn,$sql) or die ('Error');
$statement = $connection->prepare($sql);
$statement->execute();
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['FName']) && isset($_POST['Email'])  && isset($_POST['Mobile']) ) {
  $fname = $_POST['FName'];
  $email = $_POST['Email'];
  $mobile = $_POST['Mobile'];
  $sql = 'UPDATE authority SET Full_Name=:fname,Email=:email,Mobile=:mobile WHERE ID=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':fname' => $fname,':email' => $email,':mobile' => $mobile,':id' => $id])) {
    header("Location: view_profile.php");
  }



}


 ?>

 <!DOCTYPE html>
<html lang="en">
<head>

     <title>Profile</title>

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
<body>
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
                         <a href="index.html" class="navbar-brand">Student Achievement Tracker</a>
                    </div>

                    <!-- MENU LINKS -->
                    <div class="collapse navbar-collapse">
                         <ul class="nav navbar-nav navbar-nav-first">
                         <?php if($_SESSION['login_flag'] == 2){ ?>
                         <li><a href="../Authority_Home.php" class="smoothScroll">Home</a></li>
                         <li><a href="../Graphs.php" class="smoothScroll">Graph Analysis</a></li>
                         <li><a href="view_profile.php" class="smoothScroll">Profile</a></li>
                         <li><a href="../students.php" class="smoothScroll">Student</a></li>
                         <li><a href="../logout_auth.php" class="smoothScroll">Logout</a></li>
                         <?php } else if($_SESSION['login_flag'] == 3){ ?>
                         <li><a href="../Admin_Home.php" class="smoothScroll">Home</a></li>
                         <li><a href="../Graphs.php" class="smoothScroll">Graph Analysis</a></li>
                         <li><a href="../admin_profile/view_profile.php" class="smoothScroll">Profile</a></li>
                         <li><a href="../students.php" class="smoothScroll">Student</a></li>
                         <li><a href="../teachers.php" class="smoothScroll">Authority</a></li>
                         <li><a href="../logout_admin.php" class="smoothScroll">Logout</a></li>
                         <?php } ?>
                         </ul>

                         <ul class="nav navbar-nav navbar-right"></ul>
               </div>
               
          </div>
     </section>
     <section id="section1">
          <div class="top-space">
               <h1>Profile</h1>
          </div>
     </section>
</div>

     <?php if (mysqli_num_rows($result) > 0) {
  
        while ($row = mysqli_fetch_array ($result)){ ?>

     <!-- BLOG -->
     <section id="blog" data-stellar-background-ratio="0.5">
          <div class="container">
                    <div class="row ele">
                         <div class="col-md-4"></div>
                         <div class="col-md-6">
                              <div class="profile-head" id="name">
                                   <h5 class="ele">
                                        <?php echo $row ['Full_Name'];?>
                                   </h5>
                                   <h6 id="student_authority" class="ele">
                                        <?php echo $row ['Designation'];?>
                                        <?php echo $row ['Department'];?>

                                   <?php } }?>
                                   </h6>
                                   <ul class="nav nav-tabs" id="myTab" role="tablist"></ul>
                              </div>
                         </div>
                    </div>
                    <div class="row">
                         <div class="col-md-4">
                              <div class="profile-work ele">
                                   <div class="work_links">
                                        <p>WORK LINK</p>
                                        <input type="button" name="plus" id="plus" class="form-button1 img1 add" value="Add a Work Link">
                                   </div>
                                   <div class="skills">
                                        <p>SKILLS</p>
                                        <input type="button" name="plus" id="plus" class="form-button1 img1 add1" value="Add a Skill">     
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-8 ele">
                         <form method="post">
                              <div class="row">
                                   <div class="col-md-6">
                                        <label class="ele2" for="FName">Full Name</label>
                                   </div>
                                   <div class="col-md-6">
                                        <input value="<?= $person->Full_Name; ?>" type="text" name="FName" id="fname" class="input-field">
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-6">
                                        <label class="ele2" for="Email">Email</label>
                                   </div>
                                   <div class="col-md-6">
                                        <input type="email" value="<?= $person->Email; ?>" name="Email" id="email" class="input-field">
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-6">
                                        <label class="ele2" for="Mobile">Mobile No.</label>
                                   </div>
                                   <div class="col-md-6">
                                        <input value="<?= $person->Mobile; ?>" type="number" name="Mobile" id="mobile" class="input-field"  minlength="10" maxlength="10">
                                   </div>
                              </div>
                              
                              <div class="row">
                                   <div class="col-md-12 gap">
                                        <button type="submit" class="form-button">Save Changes</button>
                                   </div>
                              </div>

                            </form>
                              </div>
                         </div>
                    </div>
               </div>
     </section>

     <!-- WORK -->




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
     <script src="../js/jquery.js"></script>
     <script src="../js/bootstrap.min.js"></script>
     <script src="../js/jquery.stellar.min.js"></script>
     <script src="../js/jquery.magnific-popup.min.js"></script>
     <script src="../js/smoothscroll.js"></script>
     <script src="../js/custom.js"></script>


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