<?php require_once('processForm.php') ?>
<?php
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login"]) || $_SESSION["login"] == true ||  isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){ 
  $usernm="root";
  $passwd="";
  $host="localhost";
  $database="dbms_project";
  $_SESSION['ID'] = $id;

  $conn = mysqli_connect("localhost", "root", "root", "dbms_project", 8889);

  if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
 }

 $_SESSION['flag_file'] = 1;
 $fn = '';

 $sql = "SELECT * FROM student WHERE ID = '$id'";
 $result = mysqli_query ($conn,$sql) or die ('Error');

 $sql1 = "SELECT * FROM files where UID='$uid'";
 $result1 = mysqli_query($conn, $sql1);

 $sql2 = "SELECT * FROM sports WHERE ID = '$id'";
 $result2 = mysqli_query ($conn,$sql2) or die ('Error');

 $sql3 = "SELECT * FROM arts WHERE ID = '$id'";
 $result3 = mysqli_query ($conn,$sql3) or die ('Error');

 $sql4 = "SELECT * FROM competitive WHERE ID = '$id'";
 $result4 = mysqli_query ($conn,$sql4) or die ('Error');

 $sql5 = "SELECT * FROM social_work WHERE ID = '$id'";
 $result5 = mysqli_query ($conn,$sql5) or die ('Error');

 $sql6 = "SELECT * FROM internship WHERE ID = '$id'";
 $result6 = mysqli_query ($conn,$sql6) or die ('Error');

 $sql7 = "SELECT * FROM paper_presentation WHERE ID = '$id'";
 $result7 = mysqli_query ($conn,$sql7) or die ('Error');

 $sql8 = "SELECT * FROM project_competition WHERE ID = '$id'";
 $result8 = mysqli_query ($conn,$sql8) or die ('Error');

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
   <link rel="stylesheet" href="../css/photo.css">
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
    <ul class="nav navbar-nav navbar-nav-first navbar-right">
     <?php if($_SESSION['login_flag'] == 1){ ?>
       <li><a href="../Student_Home.php" class="smoothScroll">Home</a></li>
       <li><a href="#" class="smoothScroll">Profile</a></li>
       <li><a href="#contact" class="smoothScroll">Help</a></li>
       <li><a href="../logout_stu.php" class="smoothScroll">Logout</a></li>
     <?php } else if($_SESSION['login_flag'] == 2){ ?>
       <li><a href="../Authority_Home.php" class="smoothScroll">Home</a></li>
       <li><a href="../Graphs.php" class="smoothScroll">Graph Analysis</a></li>
       <li><a href="../teacher_profile/view_profile.php" class="smoothScroll">Profile</a></li>
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

 </div>
 
</div>
</section>
<section id="section1">
  <div class="top-space">
   <h1>Profile</h1>
 </div>
</section>
</div>

<!-- BLOG -->
<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">

    <div class="row">
     <div class="col-md-4">
      <?php if($_SESSION['login_flag'] == 1){  ?>

        <div class="profile-img">
         
         <form action="view_profile.php" method="post" enctype="multipart/form-data">
          <?php if (!empty($msg)): ?>
            <div class="alert <?php echo $msg_class ?>" role="alert">
              <?php echo $msg; ?>
            </div>
          <?php endif; ?>
          <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder" onClick="triggerClick()">
               <h4>Change Profile Photo</h4>
             </div>
             <?php if(mysqli_num_rows($result1) == 1){
               $row1 = mysqli_fetch_array ($result1);
               ?>
               <img src="<?php echo '../file/uploads/Student/'.$id.'/Profile/' . $row1['Name'] ?>" onClick="triggerClick()" id="profileDisplay">
               
             <?php }else{?>
               <img src="placeholder.jpg" onClick="triggerClick()" id="profileDisplay">
               
             <?php }?> 
           </span>
           <input type="file" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
         </div>
         <div class="form-group" >
          <button type="submit" id="submit" name="submit" class="btn btn-primary">Save</button>
        </div>
      </form>                              

    </div>
  <?php }else{  ?>
    <div class="profile-img">
      
      <?php if(mysqli_num_rows($result1) == 1){
       $row1 = mysqli_fetch_array ($result1); ?>
       <img src="<?php echo '../file/uploads/Student/'.$id.'/Profile/' . $row1['Name'] ?>" id="profileDisplay">
     <?php }else{?>
      <img src="placeholder.jpg" id="profileDisplay">                 
    <?php }?> 

  </div>
<?php } ?>
</div>

<form method="post">
 <?php
 if (mysqli_num_rows($result) > 0) {
  
   while ($row = mysqli_fetch_array ($result)){
    $fn = $row['Full_Name'];
    
    ?>
    
    <div class="col-md-6">
      <div class="profile-head" id="name">
       <h5 class="ele">
         <?php echo $row ['Full_Name'];?>
       </h5>
       <h6 id="student" class="ele">
        Student
      </h6>
      <ul class="nav nav-tabs" id="myTab" role="tablist"></ul>
    </div>
  </div>

  <div class="col-md-2">
    <?php if($_SESSION['login_flag'] == 3){ ?>                             
      <a href="admin_edit.php">Edit Profile</a>
    <?php } else if($_SESSION['login_flag'] == 1){ ?>
      <a href="edit.php" >Edit Profile</a>
    <?php } ?> 
  </div>

</div>  

<div class="row" style="margin-top: 30px;">
 <div class="col-md-4">
  <div class="profile-work ele">
   <p>WORK LINK</p>
   <a href="">Website Link</a><br/>
   <a href="">Bootsnipp Profile</a><br/>
   <a href="">Bootply Profile</a>
   <p>SKILLS</p>
   <a href="">Web Designer</a><br/>
   <a href="">Web Developer</a><br/>
   <a href="">WordPress</a><br/>
   <a href="">WooCommerce</a><br/>
   <a href="">PHP, .Net</a><br/>
 </div>
</div>
<div class="col-md-8 ele">
  <div class="row">
   <div class="col-md-6">
    <label class="ele2">Registration Id</label>
  </div>
  <div class="col-md-6">
    <p id="reg_id" class="ele1"><?php echo $row ['ID'];?></p>
  </div>
</div>
<div class="row">
 <div class="col-md-6">
  <label class="ele2">Name</label>
</div>
<div class="col-md-6">
  <p id="name" class="ele1"><?php echo $row ['Full_Name'];?></p>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <label class="ele2">Class</label>
</div>
<div class="col-md-6">
  <p id="class" class="ele1"><?php echo $row ['Class'];?></p>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <label class="ele2">Roll Number</label>
</div>
<div class="col-md-6">
  <p id="roll_no" class="ele1"><?php echo $row ['Rollno'];?></p>
</div>
</div>

<div class="row">
 <div class="col-md-6">
  <label class="ele2">Department</label>
</div>
<div class="col-md-6">
  <p id="department" class="ele1"><?php echo $row ['Department'];?></p>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <label class="ele2">Date of Birth</label>
</div>
<div class="col-md-6">
  <p id="dob" class="ele1"><?php echo $row ['DOB'];?></p>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <label class="ele2">Email</label>
</div>
<div class="col-md-6">
  <p id="email_id" class="ele1"><?php echo $row ['Email'];?></p>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <label class="ele2">Mobile No.</label>
</div>
<div class="col-md-6">
  <p id="mobile" class="ele1"><?php echo $row ['Mobile'];?></p>
</div>
</div>
<div class="row">
 <div class="col-md-6">
  <label class="ele2">Address
  </div>
  <div class="col-md-6">
    <p id="address" class="ele1"><?php echo $row ['Address'];?></p>
  </div>
</div>

</div>
</div>
<?php
}
} else {
 echo "0 results";
}
?>
</form>
</div>
</section>
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>


<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>Your Achievements</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

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
   <tbody style="text-align: left;">
     <tr>
      <th scope="row">Art</th>
      <td scope="row"><?php echo mysqli_num_rows($result3) ?></td>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
    </tr>
    <tr>
      <th scope="row">Competitive Coding</th>
      <td scope="row"><?php echo mysqli_num_rows($result4) ?></td>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
    </tr>
    <tr>
      <th scope="row">Internships</th>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
    </tr>
    <tr>
      <th scope="row">Paper Presentation</th>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
    </tr>
    <tr>
      <th scope="row">Project Completion</th>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
    </tr>
    <tr>
      <th scope="row">Socail Work</th>
      <td scope="row"><?php echo mysqli_num_rows($result5) ?></td>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
    </tr>
    <tr>
      <th scope="row">Sports</th>
      <td scope="row"><?php echo mysqli_num_rows($result2) ?></td>
      <td scope="row">0</td>
      <td scope="row">0</td>
      <td scope="row">0</td>
    </tr>
  </tbody>
</table>
</div>
</div>
</div>
</section>
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<section id="blog" data-stellar-background-ratio="0.5">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="All">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit">Print All Data</button>
  </form>

  <div class="container">
   <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="Arts">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;">Print Arts</button>
  </form>   
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>Art</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Reg. ID</th>
        <th scope="col">Type of Art</th>
        <th scope="col">Description</th>
        <th scope="col">Venue</th>
        <th scope="col">Achievements</th>
        <th scope="col">Date(Y-M-D)</th>
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result3) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result3)){
         $cnt=$cnt+1;
         ?>
         <tr>
           <th scope="row"><?php echo $cnt?></th>
           <td scope="row"><?php echo $row ['ID'];?></td>
           <td scope="row"><?php echo $row ['Art_Type'];?></td>
           <td scope="row"><?php echo $row ['Description'];?> </td>
           <td scope="row"><?php echo $row ['Venue'];?></td>
           <td scope="row"><?php echo $row ['Achievements'];?></td>
           <td scope="row"><?php echo $row ['Date_Arts'];?></td>
           <?php $_SESSION['type'] = 'Arts' ?>
           <td><a href="../file/solo_download.php?ID=<?php echo $row ['ID']?>&uid=<?php echo $row ['UID']?>" class="col-md-12 col-sm-12 form-ele2" >Download</a></td>
           
         </tr>
       </tbody>
     <?php }
   } else {
    echo "0 results";
  } ?>
</table>
</div>
</div>
</div>
</section>

<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="Comp">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;">Print Comp. Coding</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>Competitive Coding</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Reg. ID</th>
        <th scope="col">Event</th>
        <th scope="col">Description</th>
        <th scope="col">Venue</th>
        <th scope="col">Achievements</th>
        <th scope="col">Date(Y-M-D)</th>
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result4) > 0) {
       $cnt=0;
       while ($row = mysqli_fetch_array ($result4)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th>
          <td scope="row"><?php echo $row ['ID'];?></td>
          <td scope="row"><?php echo $row ['Event'];?></td>
          <td scope="row"><?php echo $row ['Description'];?></td>
          <td scope="row"><?php echo $row ['Venue'];?></td>
          <td scope="row"><?php echo $row ['Achievements'];?></td>
          <td scope="row"><?php echo $row ['Date_comp'];?></td>
          <?php $_SESSION['type'] = 'Comp' ?>
          <td><a href="../file/solo_download.php?ID=<?php echo $row ['ID']?>&uid=<?php echo $row ['UID']?>" class="col-md-12 col-sm-12 form-ele2" >Download</a></td>
          
        </tr>
      </tbody>
    <?php }
  } else {
    echo "0 results";
  } ?>
</table>
</div>
</div>
</div>
</section>

<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="Internship">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;">Print Internship</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>Internship</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Reg.ID</th>
        <th scope="col">Company</th>
        <th scope="col">Company Address</th>
        <th scope="col">Duration</th>
        <th scope="col">Type</th>
        <th scope="col">Job Role</th>
        <th scope="col">Description</th>
        <th scope="col">Stipend</th>
        <th scope="col">Source</th>
        <th scope="col">Approval</th>
        <th scope="col">Join Date(Y-M-D)</th>
        <th scope="col">End Date(Y-M-D)</th>
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result6) > 0) {
       $cnt=0;
       while ($row = mysqli_fetch_array ($result6)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th>
          <td scope="row"><?php echo $row ['ID'];?></td>
          <td scope="row"><?php echo $row ['Company'];?></td>
          
          <td scope="row"><?php echo $row ['Address'];?></td>
          <td scope="row"><?php echo $row ['Duration'];?></td>
          <td scope="row"><?php echo $row ['Type'];?></td>
          <td scope="row"><?php echo $row ['Job_Role'];?></td>
          <td scope="row"><?php echo $row ['Description'];?></td>
          <td scope="row"><?php echo $row ['Stipend'];?></td>
          <td scope="row"><?php echo $row ['Source'];?></td>
          <td scope="row"><?php echo $row ['Approve'];?></td>
          <td scope="row"><?php echo $row ['Date_Join'];?></td>
          <td scope="row"><?php echo $row ['Date_End'];?></td>
          <?php $_SESSION['type'] = 'Internship' ?>
          <td><a href="../file/solo_download.php?ID=<?php echo $row ['ID']?>&uid=<?php echo $row ['UID']?>" class="col-md-12 col-sm-12 form-ele2" >Download</a></td>
          
        </tr>
      </tbody>
    <?php }
  } else {
    echo "0 results";
  } ?>
</table>
</div>
</div>
</div>
</section>

<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="Paper">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;">Print Paper Presentation</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>Paper Presentation</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Reg.ID</th>
        <th scope="col">Title</th>
        <th scope="col">Domain</th>
        <th scope="col">Guide</th>
        <th scope="col">Organisation</th>
        <th scope="col">Date(Y-M-D)</th>
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result7) > 0) {
       $cnt=0;
       while ($row = mysqli_fetch_array ($result7)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th>
          <td scope="row"><?php echo $row ['ID'];?></td>
          <td scope="row"><?php echo $row ['Title'];?></td>
          <td scope="row"><?php echo $row ['Domain'];?></td>
          
          <td scope="row"><?php echo $row ['Guide'];?></td>
          <td scope="row"><?php echo $row ['Organisation_publish'];?></td>
          <td scope="row"><?php echo $row ['Date_publish'];?></td>
          <?php $_SESSION['type'] = 'Paper' ?>
          <td><a href="../file/solo_download.php?ID=<?php echo $row ['ID']?>&uid=<?php echo $row ['UID']?>" class="col-md-12 col-sm-12 form-ele2" >Download</a></td>
          
        </tr>
      </tbody>
    <?php }
  } else {
    echo "0 results";
  } ?>
</table>
</div>
</div>
</div>
</section>


<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="Project">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;">Print Project Competition</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>Project Competition</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Reg.ID</th>
        <th scope="col">Title</th>
        <th scope="col">Domain</th>
        <th scope="col">Type</th>
        <th scope="col">Description</th>
        <th scope="col">Guide</th>
        <th scope="col">Sponsorship</th>
        <th scope="col">Achievement</th>
        <th scope="col">Location</th>
        <th scope="col">Date(Y-M-D)</th>
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result8) > 0) {
       $cnt=0;
       while ($row = mysqli_fetch_array ($result8)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th>
          <td scope="row"><?php echo $row ['ID'];?></td>
          <td scope="row"><?php echo $row ['Title'];?></td>
          <td scope="row"><?php echo $row ['Domain'];?></td>
          <td scope="row"><?php echo $row ['Type'];?></td>
          <td scope="row"><?php echo $row ['Description'];?></td>
          <td scope="row"><?php echo $row ['Guide'];?></td>
          <td scope="row"><?php echo $row ['Sponsor'];?></td>
          <td scope="row"><?php echo $row ['Achievement'];?></td>
          <td scope="row"><?php echo $row ['Venue'];?></td>
          <td scope="row"><?php echo $row ['Date_Proj'];?></td>
          <?php $_SESSION['type'] = 'Project' ?>
          <td><a href="../file/solo_download.php?ID=<?php echo $row ['ID']?>&uid=<?php echo $row ['UID']?>" class="col-md-12 col-sm-12 form-ele2" >Download</a></td>
          
        </tr>
      </tbody>
    <?php }
  } else {
    echo "0 results";
  } ?>
</table>
</div>
</div>
</div>
</section>


<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>


<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="SW">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;">Print Social Work</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>Social Work</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Reg. ID</th>
        <th scope="col">Nature_of_work</th>
        <th scope="col">Description</th>
        <th scope="col">Associated Organisation</th>
        <th scope="col">Venue</th>
        <th scope="col">Date(Y-M-D)</th>
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result5) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result5)){
          $cnt=$cnt+1;
          ?>
          <tr>
            <th scope="row"><?php echo $cnt?></th>
            <td scope="row"><?php echo $row ['ID'];?></td>
            <td scope="row"><?php echo $row ['Nature_of_work'];?></td>
            <td scope="row"><?php echo $row ['Description'];?></td>
            <td scope="row"><?php echo $row ['Associated_org'];?></td>
            <td scope="row"><?php echo $row ['Venue'];?></td>
            <td scope="row"><?php echo $row ['Date_SW'];?></td>
            <?php $_SESSION['type'] = 'Social' ?>
            <td><a href="../file/solo_download.php?ID=<?php echo $row ['ID']?>&uid=<?php echo $row ['UID']?>" class="col-md-12 col-sm-12 form-ele2" >Download</a></td>
            
          </tr>
        </tbody>
      <?php }
    } else {
      echo "0 results";
    } ?>
  </table>
</div>
</div>
</div>
</section>
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
   <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="Sports">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit"  style="position: relative;float: right;">Print Sports</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>Sports</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Reg. ID</th>
        <th scope="col">Sports Name</th>
        <th scope="col">Description</th>
        <th scope="col">Venue</th>
        <th scope="col">Achievements</th>
        <th scope="col">Date(Y-M-D)</th>
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result2) > 0) {
       $cnt=0;
       while ($row = mysqli_fetch_array ($result2)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th>
          <td scope="row"><?php echo $row ['ID'];?></td>
          <td scope="row"><?php echo $row ['Sports_Name'];?></td>
          <td scope="row"><?php echo $row ['Description'];?></td>
          <td scope="row"><?php echo $row ['Venue'];?></td>
          <td scope="row"><?php echo $row ['Achievements'];?></td>
          <td scope="row"><?php echo $row ['Date_Sports'];?></td>
          <?php $_SESSION['type'] = 'Sports' ?>   
          <td><a href="../file/solo_download.php?ID=<?php echo $row ['ID']?>&uid=<?php echo $row ['UID']?>" class="col-md-12 col-sm-12 form-ele2" >Download</a></td>
          
        </tr>
      </tbody>
    <?php }
  } else {
    echo "0 results";
  } ?>
</table>
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
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.stellar.min.js"></script>
<script src="../js/jquery.magnific-popup.min.js"></script>
<script src="../js/smoothscroll.js"></script>
<script src="../js/custom.js"></script>
<script src="../js/photo.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $("#submit").hide();  
    $("#profileImage").on("change", function(){
      $("#submit").show();  
    })
  });
</script>
</body>
</html>

<?php 
}else{
  if($_SESSION['login_flag'] == 1){
    header("location: ../index.html");
    exit;
  }
  
  else if($_SESSION['login_flag'] == 2){
    header("location: ../index.html");
    exit;
  }

  else if($_SESSION['login_flag'] == 3){
    header("location: ../Admin_login.html");
    exit;
  }

}

?>