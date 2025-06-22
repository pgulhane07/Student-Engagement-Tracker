<?php
session_start();
if(!isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] !== true){
  header("location: Admin_login.html");
  exit;
}
$id = isset($_SESSION['ADID']) ? $_SESSION['ADID'] : '';
$_SESSION['CH'] = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>

 <title>Admin landing</title>

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
   <a href="index.html" class="navbar-brand less_margin">Achievement Tracker</a>
 </div>

 <!-- MENU LINKS -->
 <div class="collapse navbar-collapse navbar-right">
  <ul class="nav navbar-nav navbar-nav-first">
   <li><a href="#home" class="smoothScroll">Home</a></li>
   <li><a href="Graphs.php" class="smoothScroll">Graph Analysis</a></li>
   <li><a href="#" class="smoothScroll">Profile</a></li>
   <li><a href="students.php" class="smoothScroll">Student</a></li>
   <li><a href="teachers.php" class="smoothScroll">Authority</a></li>
   <li><a href="logout_admin.php" class="smoothScroll">Logout</a></li>
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
      <h1>Welcome Admin</h1>                           
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
  <button class="tablinks" onclick="openCity(event, 'Teacher')" id="defaultOpen">Teacher </button>
  <button class="tablinks" onclick="openCity(event, 'Student')">Student </button>
</div>

<div id="Teacher" class="tabcontent">
 <div class="row">
   <div class="row">   
     <div class="row">     
      <div class="col head1 ">
       <div class="section-title">
        <div class="section-title">
         <h2>Teachers</h2>
       </div>
     </div>
   </div>
 </div>  
 <div id="elem1">
   <form method="post" class="form" action="Report/printer.php">
    <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label  class="col-md-3 col-sm-3" for="start_date">Start Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="DD-MM-YYYY" name="sdate" id="start_date1">
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="end_date">End Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="DD-MM-YYYY" name="edate" id="end_date1">
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="dept">Department</label>
     <input class="col-md-3 col-sm-3" list="search1" type="text" name="dept" id="srch1" class="input-field" autocomplete="off" placeholder="Select the Department" required >
            <datalist id="search1">
              <select  name="search1" id="searchs1">
              <option  value="All">All</option>
              <option  value="Computer">Computer</option>
              <option  value="IT">IT</option>
              <option  value="ENTC">ENTC</option>
              </select>  
            </datalist>
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
     <input class="col-md-3 col-sm-3" type="text" placeholder="Enter the Title" name="month" id="month1" onchange="alert('Teacher')">
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

<div id="Student" class="tabcontent">
  <div class="row">
    
   <div class="row">     
    <div class="row">     
      <div class="col head1 ">
       <div class="section-title">
        <div class="section-title">
         <h2>Students</h2>
       </div>
     </div>
   </div>
 </div>
 <div id="elem1">
   <form method="post" class="form" action="Report/printer_stu.php">
    <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label  class="col-md-3 col-sm-3" for="start_date">Start Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="DD-MM-YYYY" name="sdate" id="start_date2">
   </div>
   <div class="col-md-12 col-sm-12 form-ele">
     <div class="col-md-2 col-sm-2"></div>
     <label class="col-md-3 col-sm-3" for="end_date">End Date</label>
     <input class="col-md-3 col-sm-3" type="date" placeholder="DD-MM-YYYY" name="edate" id="end_date2">
   </div>
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
     <input class="col-md-3 col-sm-3" type="text" placeholder="Enter the Title" name="month" id="month2" onchange="alert('Student')">
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

<div class="row">

  <div class="col-md-6 col-sm-6">
    <section id="about" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row" >
         <div class="col-md-2 col-sm-2"></div>
         <div class="col-md-6 col-sm-6">
          <div class="section-title">
            <h2><a href="register/index.php"><font color="black">Student Registration</font></a></h2>    
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
          <h2><a href="mentor/view.php"><font color="black">Add/Edit Mentor Batches</font></a></h2>    
        </div>
      </div>
    </div>
  </div>
</section>
</div>

</div>


<div class="row">
  <div class="col-md-6 col-sm-6">
   <section id="about" data-stellar-background-ratio="0.5">
    <div class="container">
     <div class="row" >
      <div class="col-md-2 col-sm-2"></div>
      <div class="col-md-6 col-sm-6">
       <div class="section-title">
        <h2><a href="auth_access/access.php"><font color="black">Teacher Allocation</font></a></h2>    
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
            <h2><a href="desg_access/access.php"><font color="black">Designation Allocation</font></a></h2>   
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

</div>

<div class="row">


  <div class="col-md-6 col-sm-6">
    <section id="about" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row" >
          <div class="col-md-2 col-sm-2"></div>
          <div class="col-md-6 col-sm-6">
            <div class="section-title">
              <h2><a href="stu_view/index.php"><font color="black">Edit Student Data</font></a></h2>  
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
            <h2><a href="authority_view/index.php"><font color="black">Edit Teacher Data</font></a></h2>    
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

</div>

<div class="row">
  
  <div class="col-md-6 col-sm-6">
    <section id="about" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row" >
          <div class="col-md-2 col-sm-2"></div>
          <div class="col-md-6 col-sm-6">
            <div class="section-title">
              <h2><a href="#"><font color="black">Add Semester Dates</font></a></h2>  
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
            <h2><a href="#"><font color="black">Admin Register</font></a></h2>    
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

</div>


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
if(select == 'Teacher'){
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


}
</script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/custom.js"></script>


</body>
</html>