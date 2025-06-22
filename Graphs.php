<?php
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

 $id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
 $link =mysqli_connect("localhost", "root", "root", "dbms_project", 8889);
 $Desg = $_SESSION['Desg'];
 $Dept = $_SESSION['Dept'];
 $CID = $_SESSION['CID'];

 if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){ 

   $query="SELECT Sports_Name,count(*) as number from sports group by Sports_Name";
   $result=mysqli_query($link,$query);
   
   $grab = "SELECT Year,count(*) as num1 FROM student s inner join sports sp WHERE s.ID=sp.ID  group by Year";
   $result1=mysqli_query($link,$grab);

   $grab2 = "SELECT Department,count(*) as num2 FROM student s inner join sports sp WHERE s.ID=sp.ID  group by Department";
   $result2=mysqli_query($link,$grab2);


   $queryart="SELECT Art_Type,count(*) as numberart from arts group by Art_Type";
   $resultart=mysqli_query($link,$queryart);

   $art2 = "SELECT Year,count(*) as numa1 FROM student s inner join arts ar WHERE s.ID=ar.ID  group by Year";
   $resultart1=mysqli_query($link,$art2);

   $art3 = "SELECT Department,count(*) as numa2 FROM student s inner join arts ar WHERE s.ID=ar.ID  group by Department";
   $resultart2=mysqli_query($link,$art3);


   $queryintern="SELECT Type,count(*) as numberintern from internship group by Type";
   $resultintern=mysqli_query($link,$queryintern);

   $intern2 = "SELECT Year,count(*) as numa1 FROM student s inner join internship ins WHERE s.ID=ins.ID  group by Year";
   $resultintern1=mysqli_query($link,$intern2);

   $intern3 = "SELECT Department,count(*) as numa2 FROM student s inner join internship ins WHERE s.ID=ins.ID  group by Department";
   $resultintern2=mysqli_query($link,$intern3);


   $querypp="SELECT Domain,count(*) as numberpp from paper_presentation group by Domain";
   $resultpp=mysqli_query($link,$querypp);

   $pp2 = "SELECT Year,count(*) as numa1 FROM student s inner join paper_presentation pp WHERE s.ID=pp.ID  group by Year";
   $resultpp1=mysqli_query($link,$pp2);

   $pp3 = "SELECT Department,count(*) as numa2 FROM student s inner join paper_presentation pp WHERE s.ID=pp.ID  group by Department";
   $resultpp2=mysqli_query($link,$pp3);


   $querypc="SELECT Domain,count(*) as numberpc from project_competition group by Domain";
   $resultpc=mysqli_query($link,$querypc);

   $pc2 = "SELECT Year,count(*) as numa1 FROM student s inner join project_competition pc WHERE s.ID=pc.ID  group by Year";
   $resultpc1=mysqli_query($link,$pc2);

   $pc3 = "SELECT Department,count(*) as numa2 FROM student s inner join project_competition pc WHERE s.ID=pc.ID  group by Department";
   $resultpc2=mysqli_query($link,$pc3);


   $querysocial="SELECT Nature_of_work,count(*) as numbersocial from social_work group by Nature_of_work";
   $resultsocial=mysqli_query($link,$querysocial);

   $social2 = "SELECT Year,count(*) as nums1 FROM student s inner join social_work sw WHERE s.ID=sw.ID  group by Year";
   $resultsocial1=mysqli_query($link,$social2);

   $social3 = "SELECT Department,count(*) as nums2 FROM student s inner join social_work sw WHERE s.ID=sw.ID  group by Department";
   $resultsocial2=mysqli_query($link,$social3);


   $querycomp="SELECT Event,count(*) as numbercomp from competitive group by Event";
   $resultcomp=mysqli_query($link,$querycomp);

   $comp2 = "SELECT Year,count(*) as numc1 FROM student s inner join competitive c WHERE s.ID=c.ID  group by Year";
   $resultcomp1=mysqli_query($link,$comp2);

   $comp3 = "SELECT Department,count(*) as numc2 FROM student s inner join competitive c WHERE s.ID=c.ID  group by Department";
   $resultcomp2=mysqli_query($link,$comp3);

 }

 else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){

   $query="SELECT Sports_Name,count(*) as number from sports sp inner join student s WHERE s.ID=sp.ID AND s.Department = '$Dept' group by Sports_Name";
   $result=mysqli_query($link,$query);
   
   $grab = "SELECT Year,count(*) as num1 FROM student s inner join sports sp WHERE s.ID=sp.ID AND s.Department = '$Dept' group by Year";
   $result1=mysqli_query($link,$grab);


   $queryart="SELECT Art_Type,count(*) as numberart from arts ar inner join student s WHERE s.ID=ar.ID AND s.Department = '$Dept' group by Art_Type";
   $resultart=mysqli_query($link,$queryart);

   $art2 = "SELECT Year,count(*) as numa1 FROM student s inner join arts ar WHERE s.ID=ar.ID AND s.Department = '$Dept' group by Year";
   $resultart1=mysqli_query($link,$art2);


   $queryintern="SELECT Type,count(*) as numberintern from internship ins inner join student s WHERE s.ID=ins.ID AND s.Department = '$Dept' group by Type";
   $resultintern=mysqli_query($link,$queryintern);

   $intern2 = "SELECT Year,count(*) as numa1 FROM student s inner join internship ins WHERE s.ID=ins.ID AND s.Department = '$Dept' group by Year";
   $resultintern1=mysqli_query($link,$intern2);


   $querypp="SELECT Domain,count(*) as numberpp from paper_presentation pp inner join student s WHERE s.ID=pp.ID AND s.Department = '$Dept' group by Domain";
   $resultpp=mysqli_query($link,$querypp);

   $pp2 = "SELECT Year,count(*) as numa1 FROM student s inner join paper_presentation pp WHERE s.ID=pp.ID AND s.Department = '$Dept' group by Year";
   $resultpp1=mysqli_query($link,$pp2);


   $querypc="SELECT Domain,count(*) as numberpc from project_competition pc inner join student s WHERE s.ID=pc.ID AND s.Department = '$Dept' group by Domain";
   $resultpc=mysqli_query($link,$querypc);

   $pc2 = "SELECT Year,count(*) as numa1 FROM student s inner join project_competition pc WHERE s.ID=pc.ID AND s.Department = '$Dept' group by Year";
   $resultpc1=mysqli_query($link,$pc2);


   $querysocial="SELECT Nature_of_work,count(*) as numbersocial from social_work sw inner join student s WHERE s.ID=sw.ID AND s.Department = '$Dept' group by Nature_of_work";
   $resultsocial=mysqli_query($link,$querysocial);

   $social2 = "SELECT Year,count(*) as nums1 FROM student s inner join social_work sw WHERE s.ID=sw.ID AND s.Department = '$Dept' group by Year";
   $resultsocial1=mysqli_query($link,$social2);


   $querycomp="SELECT Event,count(*) as numbercomp from competitive c inner join student s WHERE s.ID=c.ID AND s.Department = '$Dept' group by Event";
   $resultcomp=mysqli_query($link,$querycomp);

   $comp2 = "SELECT Year,count(*) as numc1 FROM student s inner join competitive c WHERE s.ID=c.ID AND s.Department = '$Dept' group by Year";
   $resultcomp1=mysqli_query($link,$comp2);

 }
 else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){
   
   $query="SELECT Sports_Name,count(*) as number from sports Where ClassID = '$CID' group by Sports_Name";
   $result=mysqli_query($link,$query);

   $queryart="SELECT Art_Type,count(*) as numberart from arts Where ClassID = '$CID' group by Art_Type";
   $resultart=mysqli_query($link,$queryart);

   $queryintern="SELECT Type,count(*) as numberintern from internship Where ClassID = '$CID' group by Type";
   $resultintern=mysqli_query($link,$queryintern);

   $querypp="SELECT Domain,count(*) as numberpp from paper_presentation Where ClassID = '$CID' group by Domain";
   $resultpp=mysqli_query($link,$querypp);

   $querypc="SELECT Domain,count(*) as numberpc from project_competition Where ClassID = '$CID' group by Domain";
   $resultpc=mysqli_query($link,$querypc);

   $querysocial="SELECT Nature_of_work,count(*) as numbersocial from social_work Where ClassID = '$CID' group by Nature_of_work";
   $resultsocial=mysqli_query($link,$querysocial);

   $querycomp="SELECT Event,count(*) as numbercomp from competitive Where ClassID = '$CID' group by Event";
   $resultcomp=mysqli_query($link,$querycomp);

 }

 ?>


 <!DOCTYPE html>
 <html lang="en">
 <head>

   <title>Graphs</title>

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
   <link rel="stylesheet" href="css/GraphStyles.css">

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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
 <div class="collapse navbar-collapse navbar-right">
  <ul class="nav navbar-nav navbar-nav-first">
    <?php if($_SESSION['login_flag'] == 3){ ?>
     <li><a href="Admin_Home.php" class="smoothScroll">Home</a></li>
     <li><a href="#" class="smoothScroll">Graph Analysis</a></li>
     <li><a href="#" class="smoothScroll">Profile</a></li>
     <li><a href="students.php" class="smoothScroll">Student</a></li>
     <li><a href="teachers.php" class="smoothScroll">Authority</a></li>
     <li><a href="logout_admin.php" class="smoothScroll">Logout</a></li>
   <?php  }else if($_SESSION['login_flag'] == 2){  ?>   
    <li><a href="Authority_Home.php" class="smoothScroll">Home</a></li>
    <li><a href="#" class="smoothScroll">Graph Analysis</a></li>
    <li><a href="teacher_profile/view_profile.php" class="smoothScroll">Profile</a></li>
    <li><a href="students.php" class="smoothScroll">Student</a></li>
    <li><a href="logout_auth.php" class="smoothScroll">Logout</a></li>
  <?php } ?>
</ul>

<ul class="nav navbar-nav navbar-right">
                         <!-- <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                         <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                         <li><a href="#"><i class="fa fa-instagram"></i></a></li> -->
                         <!-- <li class="section-btn"><a href="#" data-toggle="modal" data-target="#modal-form">Sign in / Join</a></li> -->
                       </ul>
                     </div>
                     
                   </div>
                 </section>
                 <section id="section1">
                  <div class="top-space">
                   <h1>Graph Analysis</h1>
                 </div>
               </section>


               <section id="blog" data-stellar-background-ratio="0.5">
                <div class="container">
                  <div class="row">

                   <div class="col">
                    <div class="section-title">
                     <div class="section-title">
                      <h2>Graphs</h2>
                      <span class="line-bar">...</span>
                    </div>
                  </div>
                </div>
                
                <div id="slide">

                  <div class="mySlides">
                   <div class="col-md-12 col-sm-12">
                    <div class="section-title">
                     <h3 class="head">Art</h3>
                     <span class="line-bar head">...</span>
                   </div>
                 </div>
                 <?php if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){ ?>
                   <div class="col-md-6 col-sm-6 shrink">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb" id="art_graph1">
                      <div class="media-object media-left">
                        <div id="piecharta" onClick="redirectart()" style="height:400px;width: 500px;margin: auto;"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 shrink">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb" id="art_graph2">
                      <div class="media-object media-left">
                        <div id="piecharta1" style="height:400px;width: 500px;margin: auto;"></div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-12 col-sm-12 shrink last">
                    <!-- BLOG THUMB -->
                    <div class="media blog-thumb" id="art_graph3">
                      <div class="media-object media-left">
                        <div id="chart_diva"  style="margin-top:10%; "></div>
                      </div>
                    </div>
                  </div>

                <?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){  ?> 
                 <div class="col-md-2 col-sm-2 shrink"></div>
                 <div class="col-md-8 col-sm-8 shrink">
                  <!-- BLOG THUMB -->
                  <div class="media blog-thumb" id="art_graph1">
                    <div class="media-object media-left">
                      <div id="piecharta" onClick="redirectart()" style="height:400px;width: 500px;margin: auto;"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 shrink"></div>
                <div class="col-md-12 col-sm-12 shrink last">
                  <!-- BLOG THUMB -->
                  <div class="media blog-thumb" id="art_graph3">
                    <div class="media-object media-left">
                      <div id="chart_diva"  style="margin-top:10%; "></div>
                    </div>
                  </div>
                </div>  
              <?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){  ?> 
                <div class="col-md-2 col-sm-2 shrink"></div>
                <div class="col-md-8 col-sm-8 shrink">
                  <!-- BLOG THUMB -->
                  <div class="media blog-thumb" id="art_graph1">
                    <div class="media-object media-left">
                      <div id="piecharta" onClick="redirectart()" style="height:400px;width: 500px;margin: auto;"></div>
                    </div>
                  </div>
                </div>
                <div class="col-md-2 col-sm-2 shrink"></div>

              <?php } ?>

            </div>

            <div class="mySlides">
             <div class="col-md-12 col-sm-12">
              <div class="section-title">
               <h3 class="head">Competitive Coding</h3>
               <span class="line-bar head">...</span>
             </div>
           </div>
           <?php if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){ ?>

             <div class="col-md-6 col-sm-6">
              <!-- BLOG THUMB -->
              <div class="media blog-thumb" id="cp_graph1">
                <div class="media-object media-left">
                  <div id="piechartc" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-6">
              <!-- BLOG THUMB -->
              <div class="media blog-thumb" id="cp_graph2">
                <div class="media-object media-left">
                  <div id="piechartc1" style="height:500px;width: 500px;margin: auto;"></div>
                </div>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 last">
              <!-- BLOG THUMB -->
              <div class="media blog-thumb" id="cp_graph3">
                <div class="media-object media-left">
                  <div id="chart_divc" style="margin-top: 10%"></div>
                </div>
              </div>
            </div>

          <?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){  ?> 
           <div class="col-md-2 col-sm-2 shrink"></div>
           <div class="col-md-8 col-sm-8 shrink">
            <!-- BLOG THUMB -->
            <div class="media blog-thumb" id="cp_graph1">
              <div class="media-object media-left">
                <div id="piechartc" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 shrink"></div>
          <div class="col-md-12 col-sm-12 shrink last">
            <!-- BLOG THUMB -->
            <div class="media blog-thumb" id="cp_graph3">
              <div class="media-object media-left">
                <div id="chart_divc" style="margin-top: 10%"></div>
              </div>
            </div>
          </div>  
        <?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){  ?> 
          <div class="col-md-2 col-sm-2 shrink"></div>
          <div class="col-md-8 col-sm-8 shrink">
            <!-- BLOG THUMB -->
            <div class="media blog-thumb" id="cp_graph1">
              <div class="media-object media-left">
                <div id="piechartc" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
              </div>
            </div>
          </div>
          <div class="col-md-2 col-sm-2 shrink"></div>

        <?php } ?>

      </div>

      <div class="mySlides">
       <div class="col-md-12 col-sm-12">
        <div class="section-title">
         <h3 class="head">Internships</h3>
         <span class="line-bar head">...</span>
       </div>
     </div>
     <?php if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){ ?>
       <div class="col-md-6 col-sm-6">
        <!-- BLOG THUMB -->
        <div class="media blog-thumb" id="internship_graph1">
          <div class="media-object media-left">
            <div id="piecharti" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <!-- BLOG THUMB -->
        <div class="media blog-thumb" id="internship_graph2">
          <div class="media-object media-left">
            <div id="piecharti1" style="height:500px;width: 500px;margin: auto;"></div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-sm-12 last">
        <!-- BLOG THUMB -->
        <div class="media blog-thumb" id="internship_graph3">
          <div class="media-object media-left">
            <div id="chart_divi" style="margin-top: 10%"></div>
          </div>
        </div>
      </div>

    <?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){  ?> 
     <div class="col-md-2 col-sm-2 shrink"></div>
     <div class="col-md-8 col-sm-8 shrink">
      <!-- BLOG THUMB -->
      <div class="media blog-thumb" id="internship_graph1">
        <div class="media-object media-left">
          <div id="piecharti" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-2 shrink"></div>
    <div class="col-md-12 col-sm-12 shrink last">
      <!-- BLOG THUMB -->
      <div class="media blog-thumb" id="internship_graph3">
        <div class="media-object media-left">
          <div id="chart_divi" style="margin-top: 10%"></div>
        </div>
      </div>
    </div>  
  <?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){  ?> 
    <div class="col-md-2 col-sm-2 shrink"></div>
    <div class="col-md-8 col-sm-8 shrink">
      <!-- BLOG THUMB -->
      <div class="media blog-thumb" id="internship_graph1">
        <div class="media-object media-left">
          <div id="piecharti" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-2 shrink"></div>

  <?php } ?>

</div>

<div class="mySlides">
 <div class="col-md-12 col-sm-12">
  <div class="section-title">
   <h3 class="head">Paper Presentation</h3>
   <span class="line-bar head">...</span>
 </div>
</div>
<?php if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){ ?>
 <div class="col-md-6 col-sm-6">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="pp_graph1">
    <div class="media-object media-left">
      <div id="piechartpp" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
    </div>
  </div>
</div>
<div class="col-md-6 col-sm-6">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="pp_graph2">
    <div class="media-object media-left">
      <div id="piechartpp1" style="height:500px;width: 500px;margin: auto;"></div>
    </div>
  </div>
</div>
<div class="col-md-12 col-sm-12 last">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="pp_graph3">
    <div class="media-object media-left">
      <div id="chart_divpp" style="margin-top: 10%"></div>
    </div>
  </div>
</div>

<?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){  ?> 
 <div class="col-md-2 col-sm-2 shrink"></div>
 <div class="col-md-8 col-sm-8 shrink">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="pp_graph1">
    <div class="media-object media-left">
      <div id="piechartpp" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
    </div>
  </div>
</div>
<div class="col-md-2 col-sm-2 shrink"></div>
<div class="col-md-12 col-sm-12 shrink last">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="pp_graph3">
    <div class="media-object media-left">
      <div id="chart_divpp" style="margin-top: 10%"></div>
    </div>
  </div>
</div>  
<?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){  ?> 
  <div class="col-md-2 col-sm-2 shrink"></div>
  <div class="col-md-8 col-sm-8 shrink">
    <!-- BLOG THUMB -->
    <div class="media blog-thumb" id="pp_graph1">
      <div class="media-object media-left">
        <div id="piechartpp" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-2 shrink"></div>

<?php } ?>

</div>

<div class="mySlides">
 <div class="col-md-12 col-sm-12">
  <div class="section-title">
   <h3 class="head">Project Competition</h3>
   <span class="line-bar head">...</span>
 </div>
</div>
<?php if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){ ?>
 <div class="col-md-6 col-sm-6">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="project_graph1">
    <div class="media-object media-left">
      <div id="piechartpc" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
    </div>
  </div>
</div>
<div class="col-md-6 col-sm-6">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="project_graph2">
    <div class="media-object media-left">
      <div id="piechartpc1" style="height:500px;width: 500px;margin: auto;"></div>
    </div>
  </div>
</div>
<div class="col-md-12 col-sm-12 last">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="project_graph3">
    <div class="media-object media-left">
      <div id="chart_divpc" style="margin-top: 10%"></div>
    </div>
  </div>
</div>

<?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){  ?> 
 <div class="col-md-2 col-sm-2 shrink"></div>
 <div class="col-md-8 col-sm-8 shrink">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="project_graph1">
    <div class="media-object media-left">
      <div id="piechartpc" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
    </div>
  </div>
</div>
<div class="col-md-2 col-sm-2 shrink"></div>
<div class="col-md-12 col-sm-12 shrink last">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="project_graph3">
    <div class="media-object media-left">
      <div id="chart_divpc" style="margin-top: 10%"></div>
    </div>
  </div>
</div>  
<?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){  ?> 
  <div class="col-md-2 col-sm-2 shrink"></div>
  <div class="col-md-8 col-sm-8 shrink">
    <!-- BLOG THUMB -->
    <div class="media blog-thumb" id="project_graph1">
      <div class="media-object media-left">
        <div id="piechartpc" onClick="redirectcom()" style="height:500px;width: 500px;margin: auto;"></div>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-2 shrink"></div>

<?php } ?>

</div>

<div class="mySlides">
 <div class="col-md-12 col-sm-12">
  <div class="section-title">
   <h3 class="head">Social Work</h3>
   <span class="line-bar head">...</span>
 </div>
</div>
<?php if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){ ?>
 <div class="col-md-6 col-sm-6">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="social_graph1">
    <div class="media-object media-left">
      <div id="piecharts" onClick="redirectsoc()" style="height:500px;width: 500px;margin: auto;"></div>
    </div>
  </div>
</div>
<div class="col-md-6 col-sm-6">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="social_graph2">
    <div class="media-object media-left">
     <div id="piecharts1"  style="height:500px;width: 500px;margin: auto;"></div>
   </div>
 </div>
</div>
<div class="col-md-12 col-sm-12 last">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="social_graph3">
    <div class="media-object media-left">
      <div id="chart_divs"  style="margin-top: 10%;"></div>
    </div>
  </div>
</div>

<?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){  ?> 
 <div class="col-md-2 col-sm-2 shrink"></div>
 <div class="col-md-8 col-sm-8 shrink">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="social_graph1">
    <div class="media-object media-left">
      <div id="piecharts" onClick="redirectsoc()" style="height:500px;width: 500px;margin: auto;"></div>
    </div>
  </div>
</div>
<div class="col-md-2 col-sm-2 shrink"></div>
<div class="col-md-12 col-sm-12 shrink last">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="social_graph3">
    <div class="media-object media-left">
      <div id="chart_divs"  style="margin-top: 10%;"></div>
    </div>
  </div>
</div>  
<?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){  ?> 
  <div class="col-md-2 col-sm-2 shrink"></div>
  <div class="col-md-8 col-sm-8 shrink">
    <!-- BLOG THUMB -->
    <div class="media blog-thumb" id="social_graph1">
      <div class="media-object media-left">
        <div id="piecharts" onClick="redirectsoc()" style="height:500px;width: 500px;margin: auto;"></div>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-2 shrink"></div>

<?php } ?>

</div>


<div class="mySlides">
 <div class="col-md-12 col-sm-12">
  <div class="section-title">
   <h3 class="head">Sports</h3>
   <span class="line-bar head">...</span>
 </div>
</div>

<?php if(($_SESSION['login_flag'] == 3) || ($_SESSION['login_flag'] == 2 &&  $_SESSION['Desg'] == 'Principal')){ ?>
 <div class="col-md-6 col-sm-6">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="sports_graph1">
    <div class="media-object media-left">
      <div class="media-object media-left"id="piechart" onClick="redirect()" style="height:400px;width: 500px;margin:auto"></div>
    </div>
  </div>
</div>
<div class="col-md-6 col-sm-6">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="sports_graph2">
    <div class="media-object media-left">
      <div id="piechart1"  style="height:400px;width: 500px;margin:auto; "></div>
    </div>
  </div>
</div>
<div class="col-md-12 col-sm-12 last">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="sports_graph3">
    <div class="media-object media-left">
      <div id="chart_div" style="margin-top:10%; "></div>
    </div>
  </div>
</div>

<?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'HOD'){  ?> 
 <div class="col-md-2 col-sm-2 shrink"></div>
 <div class="col-md-8 col-sm-8 shrink">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="sports_graph1">
    <div class="media-object media-left">
      <div class="media-object media-left"id="piechart" onClick="redirect()" style="height:400px;width: 500px;margin:auto"></div>
    </div>
  </div>
</div>
<div class="col-md-2 col-sm-2 shrink"></div>
<div class="col-md-12 col-sm-12 shrink last">
  <!-- BLOG THUMB -->
  <div class="media blog-thumb" id="sports_graph3">
    <div class="media-object media-left">
      <div id="chart_div" style="margin-top:10%; "></div>
    </div>
  </div>
</div>  
<?php  }else if($_SESSION['login_flag'] == 2 && $_SESSION['Desg'] == 'Class Teacher'){  ?> 
  <div class="col-md-2 col-sm-2 shrink"></div>
  <div class="col-md-8 col-sm-8 shrink">
    <!-- BLOG THUMB -->
    <div class="media blog-thumb" id="sports_graph1">
      <div class="media-object media-left">
        <div class="media-object media-left"id="piechart" onClick="redirect()" style="height:400px;width: 500px;margin:auto"></div>
      </div>
    </div>
  </div>
  <div class="col-md-2 col-sm-2 shrink"></div>

<?php } ?>

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


<script type="text/javascript">
  function redirect(){
    window.location.href="sports_view/index.php";

  }
  
  function redirectart(){
    window.location.href="arts_view/index.php";

  }

  function redirectintern(){
    window.location.href="internship_view/index.php";

  }
  
  function redirectsoc(){
    window.location.href="social_view/index.php";

  }
  function redirectpp(){
    window.location.href="paper_view/index.php";

  }
  function redirectpc(){
    window.location.href="comp_view/index.php";

  }
  
  function redirectcom(){
    window.location.href="comp_view/index.php";

  }
  

</script>


<!-- // for arts
--> <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartart);
  function drawChartart()
  {
    var dataa=google.visualization.arrayToDataTable([
      ['Art_Type','Number'],
      <?php 
      while($row =mysqli_fetch_array($resultart))
      {
        echo "['".$row["Art_Type"]."',".$row["numberart"]."],";
      }

      ?>

      

      ]);

    var optionsa ={
      title:'Percentage of Art types'
    };
    var charta = new google.visualization.PieChart(document.getElementById('piecharta'));
    function selectHandler() {
      var selectedItem = charta.getSelection()[0];
      if (selectedItem) {
        var topping = dataa.getValue(selectedItem.row, 0);
        window.location.href="arts_view/index.php?flag_graph=2&act="+topping;
      }
    }

    google.visualization.events.addListener(charta, 'select', selectHandler);
    charta.draw(dataa,optionsa);
  }
</script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCharta2);
  function drawCharta2()
  {
    var dataa2=google.visualization.arrayToDataTable([
      ['Department','Count'],
      <?php 
      while($row =mysqli_fetch_array($resultart2))
      {
        echo "['".$row["Department"]."',".$row["numa2"]."],";
      }

      ?>
      ]);

    var optionsa2 ={
      title:'Percentage of Department participation in Arts'
    };
    var charta2 = new google.visualization.PieChart(document.getElementById('piecharta1'));
    function selectHandler() {
      var selectedItem = charta2.getSelection()[0];
      if (selectedItem) {
        var topping = dataa2.getValue(selectedItem.row, 0);
        window.location.href="arts_view/index.php?flag_graph=1&Dept="+topping;
      }
    }

    google.visualization.events.addListener(charta2, 'select', selectHandler);  
    charta2.draw(dataa2,optionsa2);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawCharta1);
  function drawCharta1() {
    var dataa1 = google.visualization.arrayToDataTable([
      ['Year', 'count'],
      <?php 
      while($row =mysqli_fetch_array($resultart1))
      {
        echo "['".$row["Year"]."',".$row["numa1"]."],";
      }

      ?>


      ]);

    var optionsa1 = {
      title: 'Year wise arts participation',
      hAxis: {title: 'Year', titleTextStyle: {color: 'red'}},
      width: 980,
      height: 200
    };

    var charta1 = new google.visualization.ColumnChart(document.getElementById('chart_diva'));
    function selectHandler() {
      var selectedItem = charta1.getSelection()[0];
      if (selectedItem) {
        var topping = dataa1.getValue(selectedItem.row, 0);
        window.location.href="arts_view/session_m.php?Year="+topping;
      }
    }

    google.visualization.events.addListener(charta1, 'select', selectHandler);
    charta1.draw(dataa1, optionsa1);

  }
</script>


<!-- // for project competition--> <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartpc);
  function drawChartpc()
  {
    var dataa=google.visualization.arrayToDataTable([
      ['Domain','Number'],
      <?php 
      while($row =mysqli_fetch_array($resultpc))
      {
        echo "['".$row["Domain"]."',".$row["numberpc"]."],";
      }

      ?>

      

      ]);

    var optionsa ={
      title:'Percentage of project competition types'
    };
    var charta = new google.visualization.PieChart(document.getElementById('piechartpc'));
    function selectHandler() {
      var selectedItem = charta.getSelection()[0];
      if (selectedItem) {
        var topping = dataa.getValue(selectedItem.row, 0);
        window.location.href="project_competition_view/index.php?flag_graph=2&act="+topping;
      }
    }

    google.visualization.events.addListener(charta, 'select', selectHandler);
    charta.draw(dataa,optionsa);
  }
</script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCharta2);
  function drawCharta2()
  {
    var dataa2=google.visualization.arrayToDataTable([
      ['Department','Count'],
      <?php 
      while($row =mysqli_fetch_array($resultpc2))
      {
        echo "['".$row["Department"]."',".$row["numa2"]."],";
      }

      ?>
      ]);

    var optionsa2 ={
      title:'Percentage of Department participation in project competition'
    };
    var charta2 = new google.visualization.PieChart(document.getElementById('piechartpc1'));
    function selectHandler() {
      var selectedItem = charta2.getSelection()[0];
      if (selectedItem) {
        var topping = dataa2.getValue(selectedItem.row, 0);
        window.location.href="project_competition_view/index.php?flag_graph=1&Dept="+topping;
      }
    }

    google.visualization.events.addListener(charta2, 'select', selectHandler);  
    charta2.draw(dataa2,optionsa2);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawCharta1);
  function drawCharta1() {
    var dataa1 = google.visualization.arrayToDataTable([
      ['Year', 'count'],
      <?php 
      while($row =mysqli_fetch_array($resultpc1))
      {
        echo "['".$row["Year"]."',".$row["numa1"]."],";
      }

      ?>


      ]);

    var optionsa1 = {
      title: 'Year wise project compitition',
      hAxis: {title: 'Year', titleTextStyle: {color: 'red'}},
      width: 980,
      height: 200
    };

    var charta1 = new google.visualization.ColumnChart(document.getElementById('chart_divpc'));
    function selectHandler() {
      var selectedItem = charta1.getSelection()[0];
      if (selectedItem) {
        var topping = dataa1.getValue(selectedItem.row, 0);
        window.location.href="project_competition_view/session_m.php?Year="+topping;
      }
    }

    google.visualization.events.addListener(charta1, 'select', selectHandler);
    charta1.draw(dataa1, optionsa1);

  }
</script>



<!-- // for paper presentation--> <script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartpp);
  function drawChartpp()
  {
    var dataa=google.visualization.arrayToDataTable([
      ['Domain','Number'],
      <?php 
      while($row =mysqli_fetch_array($resultpp))
      {
        echo "['".$row["Domain"]."',".$row["numberpp"]."],";
      }

      ?>

      

      ]);

    var optionsa ={
      title:'Percentage of Paper Presentation.'
    };
    var charta = new google.visualization.PieChart(document.getElementById('piechartpp'));
    function selectHandler() {
      var selectedItem = charta.getSelection()[0];
      if (selectedItem) {
        var topping = dataa.getValue(selectedItem.row, 0);
        window.location.href="paper_view/index.php?flag_graph=2&act="+topping;
      }
    }

    google.visualization.events.addListener(charta, 'select', selectHandler);
    charta.draw(dataa,optionsa);
  }
</script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCharta2);
  function drawCharta2()
  {
    var dataa2=google.visualization.arrayToDataTable([
      ['Department','Count'],
      <?php 
      while($row =mysqli_fetch_array($resultpp2))
      {
        echo "['".$row["Department"]."',".$row["numa2"]."],";
      }

      ?>
      ]);

    var optionsa2 ={
      title:'Percentage of Department participation in Paper Presentation'
    };
    var charta2 = new google.visualization.PieChart(document.getElementById('piechartpp1'));
    function selectHandler() {
      var selectedItem = charta2.getSelection()[0];
      if (selectedItem) {
        var topping = dataa2.getValue(selectedItem.row, 0);
        window.location.href="paper_view/index.php?flag_graph=1&Dept="+topping;
      }
    }

    google.visualization.events.addListener(charta2, 'select', selectHandler);  
    charta2.draw(dataa2,optionsa2);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawCharta1);
  function drawCharta1() {
    var dataa1 = google.visualization.arrayToDataTable([
      ['Year', 'count'],
      <?php 
      while($row =mysqli_fetch_array($resultpp1))
      {
        echo "['".$row["Year"]."',".$row["numa1"]."],";
      }

      ?>


      ]);

    var optionsa1 = {
      title: 'Year wise paper presentaion participation',
      hAxis: {title: 'Year', titleTextStyle: {color: 'red'}},
      width: 980,
      height: 200
    };

    var charta1 = new google.visualization.ColumnChart(document.getElementById('chart_divpp'));
    function selectHandler() {
      var selectedItem = charta1.getSelection()[0];
      if (selectedItem) {
        var topping = dataa1.getValue(selectedItem.row, 0);
        window.location.href="paper_view/session_m.php?Year="+topping;
      }
    }

    google.visualization.events.addListener(charta1, 'select', selectHandler);
    charta1.draw(dataa1, optionsa1);

  }
</script>



<!-- for internship-->
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartart);
  function drawChartart()
  {
    var dataa=google.visualization.arrayToDataTable([
      ['Type','Number'],
      <?php 
      while($row =mysqli_fetch_array($resultintern))
      {
        echo "['".$row["Type"]."',".$row["numberintern"]."],";
      }

      ?>

      

      ]);

    var optionsa ={
      title:'Percentage of internship'
    };
    var charta = new google.visualization.PieChart(document.getElementById('piecharti'));
    function selectHandler() {
      var selectedItem = charta.getSelection()[0];
      if (selectedItem) {
        var topping = dataa.getValue(selectedItem.row, 0);
        window.location.href="internship_view/index.php?flag_graph=2&act="+topping;
      }
    }

    google.visualization.events.addListener(charta, 'select', selectHandler);
    charta.draw(dataa,optionsa);
  }
</script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCharta2);
  function drawCharta2()
  {
    var dataa2=google.visualization.arrayToDataTable([
      ['Department','Count'],
      <?php 
      while($row =mysqli_fetch_array($resultintern2))
      {
        echo "['".$row["Department"]."',".$row["numa2"]."],";
      }

      ?>
      ]);

    var optionsa2 ={
      title:'Percentage of Department participation in internship'
    };
    var charta2 = new google.visualization.PieChart(document.getElementById('piecharti1'));
    function selectHandler() {
      var selectedItem = charta2.getSelection()[0];
      if (selectedItem) {
        var topping = dataa2.getValue(selectedItem.row, 0);
        window.location.href="internship_view/index.php?flag_graph=1&Dept="+topping;
      }
    }

    google.visualization.events.addListener(charta2, 'select', selectHandler);  
    charta2.draw(dataa2,optionsa2);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawCharta1);
  function drawCharta1() {
    var dataa1 = google.visualization.arrayToDataTable([
      ['Year', 'count'],
      <?php 
      while($row =mysqli_fetch_array($resultintern1))
      {
        echo "['".$row["Year"]."',".$row["numa1"]."],";
      }

      ?>


      ]);

    var optionsa1 = {
      title: 'Year wise internship participation',
      hAxis: {title: 'Year', titleTextStyle: {color: 'red'}},
      width: 980,
      height: 200
    };

    var charta1 = new google.visualization.ColumnChart(document.getElementById('chart_divi'));
    function selectHandler() {
      var selectedItem = charta1.getSelection()[0];
      if (selectedItem) {
        var topping = dataa1.getValue(selectedItem.row, 0);
        window.location.href="internship_view/session_m.php?Year="+topping;
      }
    }

    google.visualization.events.addListener(charta1, 'select', selectHandler);
    charta1.draw(dataa1, optionsa1);

  }
</script>


<!-- for Social-->
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartsocial);
  function drawChartsocial()
  {
    var datas=google.visualization.arrayToDataTable([
      ['Social Work','Number'],
      <?php 
      while($row =mysqli_fetch_array($resultsocial))
      {
        echo "['".$row["Nature_of_work"]."',".$row["numbersocial"]."],";
      }

      ?>

      

      ]);

    var optionss ={
      title:'Percentage of Social work types'
    };
    var charts = new google.visualization.PieChart(document.getElementById('piecharts'));
    function selectHandler() {
      var selectedItem = charts.getSelection()[0];
      if (selectedItem) {
        var topping = datas.getValue(selectedItem.row, 0);
        window.location.href="social_view/index.php?flag_graph=2&act="+topping;
      }
    }

    google.visualization.events.addListener(charts, 'select', selectHandler);
    charts.draw(datas,optionss);
  }
</script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawCharts2);
  function drawCharts2()
  {
    var datas2=google.visualization.arrayToDataTable([
      ['Department','Count'],
      <?php 
      while($row =mysqli_fetch_array($resultsocial2))
      {
        echo "['".$row["Department"]."',".$row["nums2"]."],";
      }

      ?>
      ]);

    var optionss2 ={
      title:'Percentage of Department participation in Social work'
    };
    var charts2 = new google.visualization.PieChart(document.getElementById('piecharts1'));
    function selectHandler() {
      var selectedItem = charts2.getSelection()[0];
      if (selectedItem) {
        var topping = datas2.getValue(selectedItem.row, 0);
        window.location.href="social_view/index.php?flag_graph=1&Dept="+topping;
      }
    }

    google.visualization.events.addListener(charts2, 'select', selectHandler);  
    charts2.draw(datas2,optionss2);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawCharts1);
  function drawCharts1() {
    var datas1 = google.visualization.arrayToDataTable([
      ['Year', 'count'],
      <?php 
      while($row =mysqli_fetch_array($resultsocial1))
      {
        echo "['".$row["Year"]."',".$row["nums1"]."],";
      }

      ?>


      ]);

    var optionss1 = {
      title: 'Year wise Social work participation',
      hAxis: {title: 'Year', titleTextStyle: {color: 'red'}},
      width:980,
      height: 200
    };

    var charts1 = new google.visualization.ColumnChart(document.getElementById('chart_divs'));
    function selectHandler() {
      var selectedItem = charts1.getSelection()[0];
      if (selectedItem) {
        var topping = datas1.getValue(selectedItem.row, 0);
        window.location.href="social_view/session_m.php?&Year="+topping;
      }
    }

    google.visualization.events.addListener(charts1, 'select', selectHandler);
    charts1.draw(datas1, optionss1);

  }
</script>
<!-- forcoding -->

<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartcomp);
  function drawChartcomp()
  {
    var datac=google.visualization.arrayToDataTable([
      ['Coding','Number'],
      <?php 
      while($row =mysqli_fetch_array($resultcomp))
      {
        echo "['".$row["Event"]."',".$row["numbercomp"]."],";
      }

      ?>

      

      ]);

    var optionsc ={
      title:'Percentage of competion work types'
    };
    var chartc = new google.visualization.PieChart(document.getElementById('piechartc'));
    function selectHandler() {
      var selectedItem = chartc.getSelection()[0];
      if (selectedItem) {
        var topping = datac.getValue(selectedItem.row, 0);
        window.location.href="comp_view/index.php?flag_graph=2&act="+topping;
      }
    }

    google.visualization.events.addListener(chartc, 'select', selectHandler);
    chartc.draw(datac,optionsc);
  }
</script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChartc2);
  function drawChartc2()
  {
    var datac2=google.visualization.arrayToDataTable([
      ['Department','Count'],
      <?php 
      while($row =mysqli_fetch_array($resultcomp2))
      {
        echo "['".$row["Department"]."',".$row["numc2"]."],";
      }

      ?>
      ]);

    var optionsc2 ={
      title:'Percentage of Department participation in Comepitive work'
    };
    var chartc2 = new google.visualization.PieChart(document.getElementById('piechartc1'));
    function selectHandler() {
      var selectedItem = chartc2.getSelection()[0];
      if (selectedItem) {
        var topping = datac2.getValue(selectedItem.row, 0);
        window.location.href="comp_view/index.php?flag_graph=1&Dept="+topping;
      }
    }

    google.visualization.events.addListener(chartc2, 'select', selectHandler);  
    chartc2.draw(datac2,optionsc2);
  }
</script>

<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChartc1);
  function drawChartc1() {
    var datac1 = google.visualization.arrayToDataTable([
      ['Year', 'count'],
      <?php 
      while($row =mysqli_fetch_array($resultcomp1))
      {
        echo "['".$row["Year"]."',".$row["numc1"]."],";
      }

      ?>


      ]);

    var optionsc1 = {
      title: 'Year wise competitive work participation',
      hAxis: {title: 'Year', titleTextStyle: {color: 'red'}},
      width: 980,
      height: 200
    };

    var chartc1 = new google.visualization.ColumnChart(document.getElementById('chart_divc'));
    function selectHandler() {
      var selectedItem = chartc1.getSelection()[0];
      if (selectedItem) {
        var topping = datac1.getValue(selectedItem.row, 0);
        window.location.href="comp_view/session_m.php?&Year="+topping;
      }
    }

    google.visualization.events.addListener(chartc1, 'select', selectHandler);
    chartc1.draw(datac1, optionsc1);

  }
</script>


<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart()
  {
    var data=google.visualization.arrayToDataTable([
      ['Sport','Number'],
      <?php 
      while($row =mysqli_fetch_array($result))
      {
        echo "['".$row["Sports_Name"]."',".$row["number"]."],";
      }

      ?>

      

      ]);

    var options ={
      title:'Percentage of sports'
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    function selectHandler() {
      var selectedItem = chart.getSelection()[0];
      if (selectedItem) {
        var topping = data.getValue(selectedItem.row, 0);
        document.cookie = "topping = " + topping;
        window.location.href="sports_view/index.php?flag_graph=2&act="+topping;

      }
    }

    google.visualization.events.addListener(chart, 'select', selectHandler);
    chart.draw(data,options);
  }
</script>
<script type="text/javascript">
  google.charts.load('current',{'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart3);
  function drawChart3()
  {
    var data2=google.visualization.arrayToDataTable([
      ['Department','Count'],
      <?php 
      while($row =mysqli_fetch_array($result2))
      {
        echo "['".$row["Department"]."',".$row["num2"]."],";
      }

      ?>
      ]);

    var options2 ={
      title:'Percentage of Department participation in sports'
    };
    var chart2 = new google.visualization.PieChart(document.getElementById('piechart1'));
    function selectHandler() {
      var selectedItem = chart2.getSelection()[0];
      if (selectedItem) {
        var topping = data2.getValue(selectedItem.row, 0);
        window.location.href="sports_view/index.php?flag_graph=1?>&Dept="+topping;
      }
    }

    google.visualization.events.addListener(chart2, 'select', selectHandler);    
    chart2.draw(data2,options2);
  }

  
</script>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart1);
  function drawChart1() {
    var data1 = google.visualization.arrayToDataTable([
      ['Year', 'count'],
      <?php 
      while($row =mysqli_fetch_array($result1))
      {
        echo "['".$row["Year"]."',".$row["num1"]."],";
      }

      ?>


      ]);

    var options1 = {
      title: 'Year wise sports participation',
      hAxis: {title: 'Year', titleTextStyle: {color: 'red'}},
      width: 980,
      height: 200
    };

    var chart1 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
    function selectHandler() {
      var selectedItem = chart1.getSelection()[0];
      if (selectedItem) {
        var topping = data1.getValue(selectedItem.row, 0);     
        window.location.href="sports_view/session_m.php?Year="+topping;
              //name of link and repeat this for fe se te
            }
          }

          google.visualization.events.addListener(chart1, 'select', selectHandler);
          chart1.draw(data1, options1);

        }
      </script>




      <!-- SCRIPTS -->
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
      header("location: ../Authority_login.php");
      exit;
    }

    else if($_SESSION['login_flag'] == 3){
      header("location: ../Admin_login.php");
      exit;
    }
    
    
  }
  ?>