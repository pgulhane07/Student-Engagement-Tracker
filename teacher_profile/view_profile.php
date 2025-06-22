<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
  
  $id = isset($_POST['id']) ? $_POST['id'] : $_SESSION['AID'];
  $_SESSION['flag_file'] = 2;
  $fn = '';
  
  $sql = "SELECT * FROM Authority WHERE ID = '$id'";
  $result = mysqli_query ($conn,$sql) or die ('Error');
  
  $sql1 = "SELECT * FROM files";
  $result1 = mysqli_query($conn, $sql1);

  $sql2 = "SELECT * FROM forma WHERE ID = '$id'";
  $result2 = mysqli_query ($conn,$sql2) or die ('Error');

  $sql3 = "SELECT * FROM formb WHERE ID = '$id'";
  $result3 = mysqli_query ($conn,$sql3) or die ('Error');

  $sql21 = "SELECT * FROM formC WHERE ID = '$id'";
  $result21 = mysqli_query ($conn,$sql3) or die ('Error');

  $sql4 = "SELECT * FROM formD WHERE ID = '$id'";
  $result4 = mysqli_query ($conn,$sql4) or die ('Error');

  $sql5 = "SELECT * FROM formE WHERE ID = '$id'";
  $result5 = mysqli_query ($conn,$sql5) or die ('Error');

  $sql6 = "SELECT * FROM formF WHERE ID = '$id'";
  $result6 = mysqli_query ($conn,$sql6) or die ('Error');

  $sql7 = "SELECT * FROM formG WHERE ID = '$id'";
  $result7 = mysqli_query ($conn,$sql7) or die ('Error');

  $sql8 = "SELECT * FROM formH WHERE ID = '$id'";
  $result8 = mysqli_query ($conn,$sql8) or die ('Error');

  $sql9 = "SELECT * FROM formI WHERE ID = '$id'";
  $result9 = mysqli_query ($conn,$sql9) or die ('Error');

  $sql10 = "SELECT * FROM formJ WHERE ID = '$id'";
  $result10 = mysqli_query ($conn,$sql10) or die ('Error');

  $sql11 = "SELECT * FROM formK WHERE ID = '$id'";
  $result11= mysqli_query ($conn,$sql11) or die ('Error');

  $sql12= "SELECT * FROM formL WHERE ID = '$id'";
  $result12 = mysqli_query ($conn,$sql12) or die ('Error');

  $sql13= "SELECT * FROM formM WHERE ID = '$id'";
  $result13 = mysqli_query ($conn,$sql13) or die ('Error');

  $sql14= "SELECT * FROM formN WHERE ID = '$id'";
  $result14 = mysqli_query ($conn,$sql14) or die ('Error');

  $sql15= "SELECT * FROM formO WHERE ID = '$id'";
  $result15 = mysqli_query ($conn,$sql15) or die ('Error');

  $sql16= "SELECT * FROM formP WHERE ID = '$id'";
  $result16 = mysqli_query ($conn,$sql16) or die ('Error');

  $sql17= "SELECT * FROM formQ WHERE ID = '$id'";
  $result17 = mysqli_query ($conn,$sql17) or die ('Error');

  $sql18= "SELECT * FROM formR WHERE ID = '$id'";
  $result18 = mysqli_query ($conn,$sql18) or die ('Error');

  $sql19= "SELECT * FROM formS WHERE ID = '$id'";
  $result19 = mysqli_query ($conn,$sql19) or die ('Error');

  $sql20= "SELECT * FROM formT WHERE ID = '$id'";
  $result20 = mysqli_query ($conn,$sql20) or die ('Error');      



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
     <a href="index.html" class="navbar-brand">Authority Achievement Tracker</a>
   </div>

   <!-- MENU LINKS -->
   <div class="collapse navbar-collapse navbar-right">
    <ul class="nav navbar-nav navbar-nav-first">
      <?php if($_SESSION['login_flag'] == 2){ ?>
       <li><a href="../Authority_Home.php" class="smoothScroll">Home</a></li>
       <li><a href="../Graphs.php" class="smoothScroll">Graph Analysis</a></li>
       <li><a href="#" class="smoothScroll">Profile</a></li>
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
   <h1>Teacher Profile</h1>
 </div>
</section>
</div>
<section id="blog" data-stellar-background-ratio="0.5">
  <div class="container">
    
   <form method="post">
    <?php
    if (mysqli_num_rows($result) > 0) {
      
      while ($row = mysqli_fetch_array ($result)){
        $fn = $row['Full_Name'];
        ?>

        <div class="row ele">
         <div class="col-md-3">
          
         </div>
         <div class="col-md-6">
          <div class="profile-head" id="name">
           <h5 class="ele">
             <?php echo $row ['Full_Name'];?>
           </h5>
           <h6 id="student_authority" class="ele">
            <?php echo $row ['Designation'];?>
            <?php echo $row ['Department'];?>
          </h6>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
          </ul>
        </div>
      </div>
      <div class="col-md-2">
        <?php if($_SESSION['login_flag'] == 2 && $id == $_SESSION['AID']){ ?>
          <a href="edit.php">Edit Profile</a>
        <?php } else if($_SESSION['login_flag'] == 3){ ?>
          <a href="admin_edit.php">Edit Profile</a>
        <?php } ?>
      </div>
    </div>
    <div class="row">
     <div class="col-md-3">
      <div class="profile-work ele">
       
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
      <?php $fn = $row ['Full_Name']; ?>
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
  <label class="ele2">Department</label>
</div>
<div class="col-md-6">
  <p id="department" class="ele1"><?php echo $row ['Department'];?></p>
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

<ul class="nav nav-tabs" id="myTab" role="tablist">
  
</ul>
<section id="blog" data-stellar-background-ratio="0.5">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="All">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit">Print All Data</button>
  </form>

  <div class="container">
    <form action="printpreview.php" method="post">
      <input type="hidden" name="frm" value="FormA">
      <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
      <button type="submit" style="position: relative;float: right;">Print FormA</button>
    </form>
    <div class="row">
      <div class="col-md-12 col-sm-12">
       <div class="about-info">
        <div class="section-title">
         <h2>A. Conferences, Seminars, Symposia, Workshops, FDP, STTP Organized /conducted</h2>
         <span class="line-bar">...</span>
       </div>
     </div>
   </div>

   <div class="col-md-12 col-sm-12">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Sr. No.</th>
          <th scope="col">Activity/Event</th>
          <th scope="col">Title</th>
          <th scope="col">State / National / International</th>
          <th scope="col">Sponsoring Authority</th>
          <th scope="col">No. of Participants</th>
          <th scope="col">Name of the  coordinator(s)</th>
          <th scope="col">Remarks</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
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
            <td><?php echo $row ['Activity'];?>
            <td><?php echo $row ['Title'];?></td>
            <td><?php echo $row ['State'];?></td>
            <td><?php echo $row ['Sponsor'];?></td>
            <td><?php echo $row ['Participants'];?></td>
            <td><?php echo $row ['Coordinator'];?></td>
            <td><?php echo $row ['Remarks'];?></td>
            <td><?php echo $row ['Date_start'];?></td>
            <td><?php echo $row ['Date_end'];?></td>
            <?php $_SESSION['type'] = 'FormA' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormB">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormB</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>B. Webinar / video conference /Invited talks organized /conducted.</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Activity/Event</th>
        <th scope="col">Title</th>
        <th scope="col">Speaker/Resource Person</th>
        <th scope="col">No. of Participants</th>
        <th scope="col">Remarks</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
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
          <td><?php echo $row ['Activity'];?></td>
          <td><?php echo $row ['Title'];?></td>
          <td><?php echo $row ['Speaker'];?></td>          
          <td><?php echo $row ['Participants'];?></td>
          <td><?php echo $row ['Remarks'];?></td>
          <td><?php echo $row ['Date_start'];?></td>
          <td><?php echo $row ['Date_end'];?></td>
          <?php $_SESSION['type'] = 'FormB' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormC">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormC</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>C.  Teachers Attended Conferences, Seminars, Symposia, Workshops, FDP, STTP etc.</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Title</th>
        <th scope="col">Type/Nature</th>
        <th scope="col">Name of organizer</th>
        <th scope="col">Name of the Staff</th>
        <th scope="col">Sponsorship Details</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result21) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result21)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Title'];?></td>
          <td><?php echo $row ['Type'];?></td>
          <td><?php echo $row ['Organiser'];?></td>         
          <td><?php echo $row ['Staff'];?></td>
          <td><?php echo $row ['Sponsorship'];?></td>
          <td><?php echo $row ['Date_start'];?></td>
          <td><?php echo $row ['Date_end'];?></td>
          <?php $_SESSION['type'] = 'FormB' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormD">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormD</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
        <h3>D. Collaboration / MoU with National / International Institute/Industry /Research Center/Colleges/University.</h3>
        <span class="line-bar">...</span>
      </div>
    </div>
  </div>

  <div class="col-md-12 col-sm-12">
    <table class="table table-dark">
      <thead>
        <tr>
          <th scope="col">Sr. No.</th>
          <th scope="col">Name of Institute / Company/ Industry/Research Center</th>
          <th scope="col">Collaboration/MoU title</th>
          <th scope="col">Scope /Remark</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
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
            <td><?php echo $row ['Name'];?></td>
            <td><?php echo $row ['Collab'];?></td>
            <td><?php echo $row ['Remark'];?></td>
            <td><?php echo $row ['Date_start'];?></td>
            <td><?php echo $row ['Date_end'];?></td>
            <?php $_SESSION['type'] = 'FormD' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormE">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormE</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>E. Center  of innovation / excellence</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of Institute / Organization (if any)</th>
        <th scope="col">Area/Title/Scope</th>
        <th scope="col">Investment</th>
        <th scope="col">Remarks</th>
        <th scope="col">Date</th>
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
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Title'];?></td>           
          <td><?php echo $row ['Investment'];?></td>
          <td><?php echo $row ['Remarks'];?></td>
          <td><?php echo $row ['Date_start'];?></td>
          <?php $_SESSION['type'] = 'FormE' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>


<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormF">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormF</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>F. Industry sponsored Labs.</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of sponsoring Industry/Company</th>
        <th scope="col">Name of sponsored Lab</th>
        <th scope="col">Type of support</th>
        <th scope="col">Grant in Rs. (if any)</th>
        <th scope="col">Year of establishment</th>
        <th scope="col">Date</th>
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
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Sponsor'];?></td>           
          <td><?php echo $row ['Support'];?></td>
          <td><?php echo $row ['Grant_money'];?></td>
          <td><?php echo $row ['Year'];?></td>
          <td><?php echo $row ['Date_start'];?></td>
          <?php $_SESSION['type'] = 'FormF' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormG">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormG</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>G. Grants Received</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of Principal Investigator</th>
        <th scope="col">Name of Grant</th>
        <th scope="col">Sanctioning Authority</th>
        <th scope="col">Period of Grant</th>
        <th scope="col">Sanctioned order no.</th>
        <th scope="col">Amount</th>
        <th scope="col">Date of Sanction</th> 
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
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Grantname'];?></td>           
          <td><?php echo $row ['Authority'];?></td>
          <td><?php echo $row ['Period'];?></td>
          <td><?php echo $row ['OrderNo'];?></td>           
          <td><?php echo $row ['Amount'];?></td>
          <td><?php echo $row ['Date_start'];?></td> 
          <?php $_SESSION['type'] = 'FormG' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormH">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormH</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>H. Financial support provided to students.</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Academic Year</th>
        <th scope="col">Course</th>
        <th scope="col">Activity</th>                  
        <th scope="col">Financial Support provided</th>          
        <th scope="col">No. of students availing the support</th> 
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
          <td><?php echo $row ['Year'];?></td>
          <td><?php echo $row ['Course'];?></td>           
          <td><?php echo $row ['Activity'];?></td>
          <td><?php echo $row ['Finance'];?></td>
          <td><?php echo $row ['Count1'];?></td>
          <?php $_SESSION['type'] = 'FormH' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormI">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormI</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>I. Consultancy Projects</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of faculty (Chief Consultant)</th>
        <th scope="col">Client Organization</th>
        <th scope="col">Title of Consultancy of project</th> 
        <th scope="col">Amount received (in Rupees)</th> 
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result9) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result9)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Client'];?></td>           
          <td><?php echo $row ['Title'];?></td>
          <td><?php echo $row ['Amount'];?></td>
          <?php $_SESSION['type'] = 'FormI' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormJ">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormJ</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>J. Patent</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of the Staff</th>
        <th scope="col">Title</th>
        <th scope="col">Patent Published Yes/No (Year)</th>
        <th scope="col">Patent Granted Yes/No (Year)</th>
        <th scope="col">Patents Licensed Yes/No (Year)</th>
        <th scope="col">Earning(Amount in Rupees)</th> 
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result10) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result10)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Title'];?></td>           
          <td><?php echo $row ['Publish'];?></td>
          <td><?php echo $row ['Patent_Grant'];?></td>
          <td><?php echo $row ['License'];?></td>
          <td><?php echo $row ['Amount'];?></td>
          <?php $_SESSION['type'] = 'FormJ' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormK">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormK</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h2>K. Books / Book Chapter</h2>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of the Teacher(s)/Author</th>
        <th scope="col">Title of the Reference Books/Monographs</th>
        <th scope="col">Name and Place of Publisher(s)</th>
        <th scope="col">Hard /Soft Copy</th>
        <th scope="col">Link in case of Soft copy</th>
        <th scope="col">Isbn/Issn No.</th>
        <th scope="col">Date of Publication</th>  
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result11) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result11)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Title'];?></td>           
          <td><?php echo $row ['Publisher'];?></td>     
          <td><?php echo $row ['Copy'];?></td>
          <td><?php echo $row ['Link'];?></td>
          <td><?php echo $row ['Isbn'];?></td>
          <td><?php echo $row ['Date_start'];?></td> 
          <?php $_SESSION['type'] = 'FormK' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormL">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormL</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>L. Research Publications in National and International Journals/Edited Books/Proceedings/Conference</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of the Teacher's/Author</th>
        <th scope="col">Title of the Paper</th>
        <th scope="col">Name of the Journal/Proceeding/Edited Book/Conference</th>
        <th scope="col">Level (State / National / International)</th>
        <th scope="col">Volume/No / Issue </th>          
        <th scope="col">Pages</th>
        <th scope="col">Year</th>
        <th scope="col">ISBN/ISSN No.</th>
        <th scope="col">Publisher </th>  
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result12) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result12)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Title'];?></td>
          <td><?php echo $row ['Journal'];?></td>
          <td><?php echo $row ['Level'];?></td>
          <td><?php echo $row ['Volume'];?></td>
          <td><?php echo $row ['Page'];?></td>
          <td><?php echo $row ['Year'];?></td>
          <td><?php echo $row ['Isbn'];?></td>
          <td><?php echo $row ['Publisher'];?></td> 
          <?php $_SESSION['type'] = 'FormL' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormM">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormM</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>M. Research Projects/Schemes Undertaken by Teachers</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of the Investigator(s)</th>
        <th scope="col">Faculty (Stream)</th>
        <th scope="col">Title of the Research Project/Scheme</th>        
        <th scope="col">Sanctioned order no.& Date</th>
        <th scope="col">Name of the Funding Agency</th>
        <th scope="col">Duration of the Project/Scheme (Dates)</th>
        <th scope="col">Amount Sanctioned(Rs.)</th>
        <th scope="col">Major/Minor</th>   
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result13) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result13)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Faculty'];?></td>
          <td><?php echo $row ['Title'];?></td>
          <td><?php echo $row ['Sanction'];?></td>
          <td><?php echo $row ['Fund'];?></td>
          <td><?php echo $row ['Duration'];?></td>
          <td><?php echo $row ['Amount'];?></td>
          <td><?php echo $row ['Major'];?></td> 
          <?php $_SESSION['type'] = 'FormM' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormN">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormN</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>N. Staff Achievement</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of Staff</th>
        <th scope="col">Achievement</th>
        <th scope="col">Remark</th>   
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result14) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result14)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Achievement'];?></td>
          <td><?php echo $row ['Remark'];?></td> 
          <?php $_SESSION['type'] = 'FormN' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormO">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormO</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>O. Student Achievement</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of Student</th>
        <th scope="col">Class</th>
        <th scope="col">Achievement</th>
        <th scope="col">Remark</th>   
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result15) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result15)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Class'];?></td>
          <td><?php echo $row ['Achievement'];?></td>
          <td><?php echo $row ['Remark'];?></td> 
          <?php $_SESSION['type'] = 'FormO' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormP">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormP</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>P. Departmental Achievement</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Department</th>
        <th scope="col">Achievement Description</th>   
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result16) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result16)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Department'];?></td>
          <td><?php echo $row ['Description'];?></td> 
          <?php $_SESSION['type'] = 'FormP' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormQ">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormQ</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>Q. Technical Competitions / Tech Fest Organized / Participated</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of Technical Competition/Techfest</th>
        <th scope="col">No. of participants</th>
        <th scope="col">Duration</th>
        <th scope="col">Name of student / Staff Participated</th>
        <th scope="col">Prize  / Rank Obtained</th>
        <th scope="col">Level</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>   
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result17) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result17)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Participants'];?></td>
          <td><?php echo $row ['Duration'];?></td>
          <td><?php echo $row ['Participant_name'];?></td>
          <td><?php echo $row ['Prize'];?></td>
          <td><?php echo $row ['Level'];?></td>
          <td><?php echo $row ['Date_start'];?></td>
          <td><?php echo $row ['Date_end'];?></td> 
          <?php $_SESSION['type'] = 'FormQ' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormR">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormR</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>R. Industrial Visits / Tours</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name and address of the Company / Industry visited</th>
        <th scope="col">Purpose of the visit</th>
        <th scope="col">No. of Students</th>         
        <th scope="col">Coordinator(s)</th>
        <th scope="col">Date of visit</th>   
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result18) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result18)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Purpose'];?></td>           
          <td><?php echo $row ['Students'];?></td>
          <td><?php echo $row ['Coordinator'];?></td>
          <td><?php echo $row ['Date_start'];?></td> 
          <?php $_SESSION['type'] = 'FormR' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormS">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormS</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>S. Resource Person</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of faculty</th>
        <th scope="col">Name of FDP / Workshop / Other</th>
        <th scope="col">Level</th>
        <th scope="col">Topic</th>
        <th scope="col">Organizer</th> 
        <th scope="col">Date</th>   
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result19) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result19)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['FDP'];?></td>
          <td><?php echo $row ['Level'];?></td>
          <td><?php echo $row ['Topic'];?></td>
          <td><?php echo $row ['Organizer'];?></td>
          <td><?php echo $row ['Date_start'];?></td> 
          <?php $_SESSION['type'] = 'FormS' ?>
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
<ul class="nav nav-tabs" id="myTab" role="tablist"></ul>

<div class="container">
  <form action="printpreview.php" method="post">
    <input type="hidden" name="frm" value="FormT">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <input type="hidden" name="fn" value="<?php echo $fn;?>">  
    <button type="submit" style="position: relative;float: right;margin-top: 5%;">Print FormT</button>
  </form>
  <div class="row">
    <div class="col-md-12 col-sm-12">
     <div class="about-info">
      <div class="section-title">
       <h3>T. Any other information (As applicable )</h3>
       <span class="line-bar">...</span>
     </div>
   </div>
 </div>

 <div class="col-md-12 col-sm-12">
  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">Sr. No.</th>
        <th scope="col">Name of the Activity</th>
        <th scope="col">Organizer</th>
        <th scope="col">Name/No. of participants</th>
        <th scope="col">Duration</th>
        <th scope="col">Prize  / Rank Obtained</th>
        <th scope="col">Remark</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>   
        <th scope="col">Certificate</th>
      </tr>
    </thead>
    <tbody style="text-align: left;">
      <?php if (mysqli_num_rows($result20) > 0) {
        $cnt=0;
        while ($row = mysqli_fetch_array ($result20)){
         $cnt=$cnt+1;
         ?>
         <tr>
          <th scope="row"><?php echo $cnt?></th> 
          <td><?php echo $row ['Name'];?></td>
          <td><?php echo $row ['Organizer'];?></td>
          <td><?php echo $row ['Participants'];?></td>
          <td><?php echo $row ['Duration'];?></td>
          <td><?php echo $row ['Prize'];?></td>
          <td><?php echo $row ['Remark'];?>
          <td><?php echo $row ['Date_start'];?></td>
          <td><?php echo $row ['Date_end'];?></td> 
          <?php $_SESSION['type'] = 'FormT' ?>
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

<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.stellar.min.js"></script>
<script src="../js/jquery.magnific-popup.min.js"></script>
<script src="../js/smoothscroll.js"></script>
<script src="../js/custom.js"></script>

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
