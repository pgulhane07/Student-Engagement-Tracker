<?php
session_start();
require 'config.php';

if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
  header("location: index.html");
  exit;
}
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$name = '';
$mentor = false;
$class="";
$sql = "SELECT a.*,at1.Designation,at1.Department FROM access a INNER JOIN Authority at1 ON a.TeacherID = at1.ID where TeacherID='$id' ";
$sql1 = "SELECT * from authority WHERE ID ='$id'";
$result = mysqli_query ($conn,$sql) or die ('Error');
$result1 = mysqli_query ($conn,$sql1) or die ('Error');
if(mysqli_num_rows($result)!=0)
{
  $message="Please click this button";
  $row = mysqli_fetch_array ($result);
  $class = $row ['ClassID'];
  $_SESSION['CID'] = $class;
}        

if(mysqli_num_rows($result1)!=0){
 $row1 = mysqli_fetch_array ($result1);
 $Desg = $row1 ['Designation'];
 $Dept = $row1 ['Department'];
 $name = $row1 ['Full_Name'];
 $_SESSION['Desg'] = $Desg;
 $_SESSION['Dept'] = $Dept;
}

$sql2 = "SELECT m.* FROM Mentor m INNER JOIN Authority at ON m.TeacherID = at.ID where TeacherID='$id'";

$result2 = mysqli_query ($conn,$sql2) or die ('Error');
if(mysqli_num_rows($result2)!=0){
  $row2 = mysqli_fetch_array ($result2);
  $batch = $row2['Batch'];
  $rf = $row2['Roll_from'];
  $rt = $row2['Roll_to'];
  $mentor = true;      
  $_SESSION['rf'] = $rf;
  $_SESSION['rt'] = $rt;
  $_SESSION['batch'] = $batch;
}
$_SESSION['mentor'] = $mentor;
//echo $mentor;

$sql3 = "SELECT d.* FROM designation_access d INNER JOIN Authority at ON d.TeacherID = at.ID where TeacherID='$id' AND d.Designation = 'HOD'";

$result3 = mysqli_query ($conn,$sql3) or die ('Error');
if(mysqli_num_rows($result3)==1){          
  $_SESSION['CH'] = true;
}




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
 <link rel="stylesheet" href="css/tab_switch.css">

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
   <a href="Authority_Home.php" class="navbar-brand less_margin">Authority Achievement Tracker</a>
 </div>

 <!-- MENU LINKS -->
 <div class="collapse navbar-collapse navbar-right">
  <ul class="nav navbar-nav navbar-nav-first">
   <li><a href="#home" class="smoothScroll">Home</a></li>
   <li><a href="teacher_profile/view_profile.php" class="smoothScroll">Profile</a></li>
   <li><a href="Graphs.php" class="smoothScroll">Graph Analysis</a></li>
   <li><a href="students.php" class="smoothScroll">Student</a></li>
   <li><a href="logout_auth.php" class="smoothScroll">Logout</a></li>
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
      <h1>Welcome<br> 
        <?php echo 'Prof. '.$name;?> <br>
        <?php if($Desg == 'Principal'){ 
         echo $Desg.' - PICT';
       }else if($Desg == 'HOD'){
         echo $Desg.' - '.$Dept.' Department';                              
       }else if($Desg == 'Class Teacher'){
         echo $Desg.' - '.substr($class, 0,3).' Class'; ?> <br><?php                  
         if($_SESSION['mentor'] == true){
          echo ' Mentor : '.$_SESSION['batch'].' Batch ';
        } ?> <br><?php  
        if(isset($_SESSION['CH'])){
          echo ' Committee Head : '.$_SESSION['Dept'].' Department ';
        }

      } ?>
      
    </h1>
  </div>
</div>



</div>
</div>
</section>
<section id="work" data-stellar-background-ratio="0.5">
  <div class="col head1 ">
   <div class="section-title">
    <div class="section-title">
     <h2>Monthly Report Generator</h2>
     <span class="line-bar">...</span>
   </div>
 </div>
</div>
</div>

<div class="tab1">
  <button class="tablinks" onclick="openCity(event, 'Self')" id="defaultOpen">Self</button>
  <?php if($Desg != 'Class Teacher'){ ?>
    <button class="tablinks" onclick="openCity(event, 'Teacher')">Teacher </button>
  <?php }if($mentor){ ?>
    <button class="tablinks" onclick="openCity(event, 'Mentor')">Mentor </button>
  <?php } ?>
  <button class="tablinks" onclick="openCity(event, 'Student')">Student </button>
</div>

<div id="Self" class="tabcontent">
  <div class="row">
   <div class="row">     
    <div class="col head1 ">
     <div class="section-title">
      <div class="section-title">
       <h2>Self</h2>
     </div>
   </div>
 </div>
</div>
<div id="elem1">
 <form method="post" class="form" action="Report/printer.php">
  <div class="col-md-12 col-sm-12 form-ele">
   <div class="col-md-2 col-sm-2"></div>
   <label  class="col-md-3 col-sm-3" for="start_date">Start Date</label>
   <input class="col-md-3 col-sm-3" type="date" placeholder="dd-mm-yyyy" name="sdate" id="start_date">
 </div>
 <div class="col-md-12 col-sm-12 form-ele">
   <div class="col-md-2 col-sm-2"></div>
   <label class="col-md-3 col-sm-3" for="end_date">End Date</label>
   <input class="col-md-3 col-sm-3" type="date" placeholder="dd-mm-yyyy" name="edate" id="end_date">
 </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="form">Form</label>
     <input class="col-md-3 col-sm-3" list="search2" type="text" name="form" id="srch2" class="input-field" autocomplete="off" placeholder="Select the Form" required >
            <datalist id="search2">
              <select  name="search2" id="searchs2">
              <option  value="All">All</option>
              <option  value="Form A">Form A</option>
              <option  value="Form B">Form B</option>
              <option  value="Form C">Form C</option>
              <option  value="Form D">Form D</option>
              <option  value="Form E">Form E</option>
              <option  value="Form F">Form F</option>
              <option  value="Form G">Form G</option>
              <option  value="Form H">Form H</option>
              <option  value="Form I">Form I</option>
              <option  value="Form J">Form J</option>
              <option  value="Form K">Form K</option>
              <option  value="Form L">Form L</option>
              <option  value="Form M">Form M</option>
              <option  value="Form N">Form N</option>
              <option  value="Form O">Form O</option>
              <option  value="Form P">Form P</option>
              <option  value="Form Q">Form Q</option>
              <option  value="Form R">Form R</option>
              <option  value="Form S">Form S</option>
              <option  value="Form T">Form T</option>
              </select>  
            </datalist>
   </div>
 <div class="col-md-12 col-sm-12 form-ele">
   <div class="col-md-2 col-sm-2"></div>
   <label class="col-md-3 col-sm-3" for="month">Title</label>
   <input class="col-md-3 col-sm-3" type="text" placeholder="Enter the Title" name="month" id="month" onchange="alert('Self')">
 </div>
 <div class="col-md-12 col-sm-12 form-ele">
   <div class="col-md-4 col-sm-4"></div>
   <input type="hidden" name="flg" value="1">
   <button type="submit" class="col-md-3 col-sm-3 form-ele1" id="report_button">Preview the report</button><br>
 </div>
 
</form>
<div class="col-md-12 col-sm-12 form-ele">
 <div class="col-md-4 col-sm-4"></div>
 <form action="teacher_profile/printpreview.php" method="post">
   <input type="hidden" name="frm" value="All">
   <input type="hidden" name="fn" value="<?php echo $name;?>">  
   <button type="submit" class="col-md-3 col-sm-3 form-ele1">Print All Data</button>
 </form>
</div>
</div>
</div>
</div>
</div>

<div id="Teacher" class="tabcontent">
 <div class="row">
   <div class="row">   
     <div class="row">     
      <div class="col head1 ">
       <div class="section-title">
        <div class="section-title">
         <h2>Teachers ( <?php if($Desg == 'HOD'){echo $Dept.' Department';}?> )</h2>
       </div>
     </div>
   </div>
 </div>  
 <div id="elem1">
   <form method="post" class="form" action="Report/printer.php">
    <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label  class="col-md-3 col-sm-3" for="start_date">Start Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="dd-mm-yyyy" name="sdate" id="start_date1">
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="end_date">End Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="dd-mm-yyyy" name="edate" id="end_date1">
   </div>
   <?php if($Desg == 'Principal' || $Desg == 'Director'){ ?>
    <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="dept">Department</label>
     <input class="col-md-3 col-sm-3" list="search3" type="text" name="dept" id="srch3" class="input-field" autocomplete="off" placeholder="Select the Department" required >
            <datalist id="search3">
              <select  name="search3" id="searchs3">
              <option  value="All">All</option>
              <option  value="Computer">Computer</option>
              <option  value="IT">IT</option>
              <option  value="ENTC">ENTC</option>
              </select>  
            </datalist>
   </div>
   <?php } ?> 
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="form">Form</label>
     <input class="col-md-3 col-sm-3" list="search2" type="text" name="form" id="srch2" class="input-field" autocomplete="off" placeholder="Select the Form" required >
            <datalist id="search2">
              <select  name="search2" id="searchs2">
              <option  value="All">All</option>
              <option  value="Form A">Form A</option>
              <option  value="Form B">Form B</option>
              <option  value="Form C">Form C</option>
              <option  value="Form D">Form D</option>
              <option  value="Form E">Form E</option>
              <option  value="Form F">Form F</option>
              <option  value="Form G">Form G</option>
              <option  value="Form H">Form H</option>
              <option  value="Form I">Form I</option>
              <option  value="Form J">Form J</option>
              <option  value="Form K">Form K</option>
              <option  value="Form L">Form L</option>
              <option  value="Form M">Form M</option>
              <option  value="Form N">Form N</option>
              <option  value="Form O">Form O</option>
              <option  value="Form P">Form P</option>
              <option  value="Form Q">Form Q</option>
              <option  value="Form R">Form R</option>
              <option  value="Form S">Form S</option>
              <option  value="Form T">Form T</option>
              </select>  
            </datalist>
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="month">Title</label>
     <input class="col-md-3 col-sm-3" type="text" placeholder="Enter the Title" name="month" id="month1" onchange="alert('Teacher')">
   </div>
   <div class="col-md-12 col-sm-12">
     <div class="col-md-4 col-sm-4"></div>
     <input type="hidden" name="flg" value="2">
     <button type="submit" class="col-md-3 col-sm-3 form-ele1" id="report_button">Preview the report</button>
   </div>
 </form>
</div>

</div>
</div> 
</div>

<div id="Mentor" class="tabcontent">
 <div class="row">
   <div class="row">   
     <div class="row">     
      <div class="col head1 ">
       <div class="section-title">
        <div class="section-title">
         <h2>Batch ( <?php if($mentor){echo $batch;}?> )</h2>
       </div>
     </div>
   </div>
 </div>  
 <div id="elem1">
   <form method="post" class="form" action="Report/printer_stu.php">
    <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label  class="col-md-3 col-sm-3" for="start_date">Start Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="dd-mm-yyyy" name="sdate" id="start_date3">
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="end_date">End Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="dd-mm-yyyy" name="edate" id="end_date3">
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="form">Activity</label>
     <input class="col-md-3 col-sm-3" list="search4" type="text" name="form" id="srch4" class="input-field" autocomplete="off" placeholder="Select the Activity" required >
            <datalist id="search4">
              <select  name="search4" id="searchs4">
              <option  value="All">All</option>
              <option  value="Arts">Arts</option>
              <option  value="Competative Coding">Competative Coding</option>
              <option  value="Internships">Internships</option>
              <option  value="Paper Presentation">Paper Presentation</option>
              <option  value="Project Competition">Project Competition</option>
              <option  value="Social Work">Social Work</option>
              <option  value="Sports">Sports</option>
              </select>  
            </datalist>
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="month">Title</label>
     <input class="col-md-3 col-sm-3" type="text" placeholder="Enter the Title" name="month" id="month3" onchange="alert('Mentor')">
   </div>
   <input type="hidden" name="rf" value="<?php echo $rf;?>">
   <input type="hidden" name="rt" value="<?php echo $rt;?>">
   <div class="col-md-12 col-sm-12">
     <div class="col-md-4 col-sm-4"></div>
     <button type="submit" class="col-md-3 col-sm-3 form-ele1" id="report_button">Preview the report</button>
   </div>
 </form>
</div>

</div>
</div> 
</div>

<div id="Student" class="tabcontent">
  <div class="row">
    
   <div class="row">     
    <div class="row">     
      <div class="col head1 ">
       <div class="section-title">
        <div class="section-title">
         <h2>Students ( <?php if($Desg == 'HOD'){echo $Dept.' Department';}else if($Desg == 'Class Teacher'){ echo substr($class, 0,3).' Class';}?> )</h2>
       </div>
     </div>
   </div>
 </div>
 <div id="elem1">
   <form method="post" class="form" action="Report/printer_stu.php">
    <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label  class="col-md-3 col-sm-3" for="start_date">Start Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="dd-mm-yyyy" name="sdate" id="start_date2">
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="end_date">End Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="dd-mm-yyyy" name="edate" id="end_date2">
   </div>
   <?php if($Desg == 'Principal' || $Desg == 'Director'){ ?>
    <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="dept">Department</label>
     <input class="col-md-3 col-sm-3" list="search3" type="text" name="dept" id="srch3" class="input-field" autocomplete="off" placeholder="Select the Department" required >
            <datalist id="search3">
              <select  name="search3" id="searchs3">
              <option  value="All">All</option>
              <option  value="Computer">Computer</option>
              <option  value="IT">IT</option>
              <option  value="ENTC">ENTC</option>
              </select>  
            </datalist>
   </div>
   <?php } ?> 

   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="form">Activity</label>
     <input class="col-md-3 col-sm-3" list="search4" type="text" name="form" id="srch4" class="input-field" autocomplete="off" placeholder="Select the Activity" required >
            <datalist id="search4">
              <select  name="search4" id="searchs4">
              <option  value="All">All</option>
              <option  value="Arts">Arts</option>
              <option  value="Competative Coding">Competative Coding</option>
              <option  value="Internships">Internships</option>
              <option  value="Paper Presentation">Paper Presentation</option>
              <option  value="Project Competition">Project Competition</option>
              <option  value="Social Work">Social Work</option>
              <option  value="Sports">Sports</option>
              </select>  
            </datalist>
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="month">Month</label>
     <input class="col-md-3 col-sm-3" type="text" placeholder="Enter the month" name="month" id="month2" onchange="alert('Student')">
   </div>
   <div class="col-md-12 col-sm-12">
     <div class="col-md-4 col-sm-4"></div>
     <button type="submit" class="col-md-3 col-sm-3 form-ele1" id="report_button">Preview the report</button>
   </div>
 </form>
</div>

</div>
</div> 
</div>
</section>
<hr>


<div class="row">
  <div class="col-md-6 col-sm-6">
    <section id="about" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row" >
          <div class="col-md-2 col-sm-2"></div>
          <div class="col-md-6 col-sm-6">
            <div class="section-title">
              <h2><a href="stu_view/index.php"><font color="black">Students Information</font></a></h2>  
            </div>
          </div> 
        </div>
      </div>
    </section>
  </div>

  <div class="col-md-6 col-sm-6">
    <section id="about" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row" >
         <div class="col-md-2 col-sm-2"></div>
         <div class="col-md-6 col-sm-6">
          <div class="section-title">
            <h2><a href="students.php"><font color="black">Students Achievements</font></a></h2>    
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>

<?php if($Desg == 'Class Teacher'){ ?>
  <div class="row">
    <div class="col-md-6 col-sm-6">
      <section id="about" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row" >
           <div class="col-md-2 col-sm-2"></div>
           <div class="col-md-6 col-sm-6">
            <div class="section-title">
              <h2><a href="mentor/access.php"><font color="black">Mentor Allocation for <?php echo substr($class, 0,3).' Class'; ?> </font></a></h2>    
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  

  <?php if($_SESSION['mentor'] == true){ ?>
    <div class="col-md-6 col-sm-6">
      <section id="about" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row" >
           <div class="col-md-2 col-sm-2"></div>
           <div class="col-md-6 col-sm-6">
            <div class="section-title">
              <h2><a href="stu_view/index.php"><font color="black">Batch Info : <?php echo $_SESSION['batch'].' Batch '; ?> </font></a></h2>    
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php } ?>
<?php if(isset($_SESSION['CH'])){ ?>
  <div class="col-md-6 col-sm-6">
    <section id="about" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row" >
         <div class="col-md-2 col-sm-2"></div>
         <div class="col-md-6 col-sm-6">
          <div class="section-title">
            <h2><a href="teachers.php"><font color="black">Teachers Achievements</font></a></h2>    
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php } ?>
</div>
<?php } if($Desg != 'Class Teacher'){ ?>
  <div class="row">
    <div class="col-md-6 col-sm-6">
      <section id="about" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row" >
            <div class="col-md-2 col-sm-2"></div>
            <div class="col-md-6 col-sm-6">
              <div class="section-title">
                <h2><a href="authority_view/index.php"><font color="black">Teachers Information</font></a></h2>  
              </div>
            </div> 
          </div>
        </div>
      </section>
    </div>
    <div class="col-md-6 col-sm-6">
      <section id="about" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row" >
           <div class="col-md-2 col-sm-2"></div>
           <div class="col-md-6 col-sm-6">
            <div class="section-title">
              <h2><a href="teachers.php"><font color="black">Teachers Achievements</font></a></h2>    
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php } ?>
<hr>


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
    <h3><a href="teacherforms/FormA/index.php">A. Conferences, Seminars, Symposia, Workshops, FDP, STTP Organized /conducted. </a></h3>
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
    <h3><a href="teacherforms/FormB/index.php">B. Webinar / video conference /Invited talks organized /conducted.</a></h3>
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
    <h3><a href="teacherforms/FormC/index.php">C. Teachers Attended Conferences, Seminars, Symposia, Workshops, FDP, STTP etc.</a></h3>
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
    <h3><a href="teacherforms/FormD/index.php">D. Collaboration / MoU with National / International Institute/Industry /Research Center/Colleges/University.</a></h3>
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
    <h3><a href="teacherforms/FormE/index.php">E. Center  of innovation / excellence.</a></h3>
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
    <h3><a href="teacherforms/FormF/index.php">F. Industry sponsored Labs.</a></h3>
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
    <h3><a href="teacherforms/FormG/index.php">G. Grants Received.</a></h3>
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
    <h3><a href="teacherforms/FormH/index.php">H. Financial support provided to students </a></h3>
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
    <h3><a href="teacherforms/FormI/index.php">I. Consultancy Projects.</a></h3>
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
    <h3><a href="teacherforms/FormJ/index.php">J. Patent </a></h3>
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
    <h3><a href="teacherforms/FormK/index.php">K. Books / Book Chapter</a></h3>
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
    <h3><a href="teacherforms/FormL/index.php">L. Research Publications in National and International Journals/Edited Books/Proceedings/Conference</a></h3>
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
    <h3><a href="teacherforms/FormM/index.php">M. Research Projects/Schemes Undertaken by Teachers</a></h3>
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
    <h3><a href="teacherforms/FormN/index.php">N. Staff Achievement</a></h3>
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
    <h3><a href="teacherforms/FormO/index.php">O. Student Achievement</a></h3>
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
    <h3><a href="teacherforms/FormP/index.php">P. Departmental Achievement</a></h3>
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
    <h3><a href="teacherforms/FormQ/index.php">Q. Technical Competitions / Tech Fest Organized / Participated</a></h3>
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
    <h3><a href="teacherforms/FormR/index.php">R. Industrial Visits / Tours</a></h3>
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
    <h3><a href="teacherforms/FormS/index.php">S. Resource Person.</a></h3>
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
    <h3><a href="teacherforms/FormT/index.php">T. Any other information (As applicable )</a></h3>
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
</script>
<script type="text/javascript">
 function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

function alert(tab){
  var select  = tab;
  var months=["january", "february", "march", "april", "may", "june", "july", "august", "september", "october", "november", "december"];
  var year=new Date().getFullYear();
  var start_date=["-01-01","-02-01","-03-01","-04-01","-05-01","-06-01","-07-01","-08-01","-09-01","-10-01","-11-01","-12-01"];
  var end_date=["-01-31","-02-28","-03-31","-04-30","-05-31","-06-30","-07-31","-08-31","-09-30","-10-31","-11-30","-12-31"];
  if(year%4==0)
  {
   if(year%100==0)
   {
    if(year%400==0)
    {
     end_date[1]="-02-29";
   }
 }
 else
 {
  end_date[1]="-02-29";
}
}

var month;
if(select == 'Self'){
 month=document.getElementById('month').value;
 month=month.toLowerCase();
 for (var i = 0; i < 12; i++) {
   if(months[i]==month)
   {
    document.getElementById('start_date').value=year+start_date[i];
    document.getElementById('end_date').value=year+end_date[i];
  }
}

}else if(select == 'Teacher'){
 month=document.getElementById('month1').value;
 month=month.toLowerCase();
 for (var i = 0; i < 12; i++) {
   if(months[i]==month)
   {
    document.getElementById('start_date1').value=year+start_date[i];
    document.getElementById('end_date1').value=year+end_date[i];
  }
}

}else if(select == 'Student'){
 month=document.getElementById('month2').value;
 month=month.toLowerCase();
 for (var i = 0; i < 12; i++) {
   if(months[i]==month)
    document.getElementById('start_date2').value=year+start_date[i];
  document.getElementById('end_date2').value=year+end_date[i];
}
}
else if(select == 'Mentor'){
 month=document.getElementById('month3').value;
 month=month.toLowerCase();
 for (var i = 0; i < 12; i++) {
   if(months[i]==month)
    document.getElementById('start_date3').value=year+start_date[i];
  document.getElementById('end_date3').value=year+end_date[i];
}
}


}
</script>
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