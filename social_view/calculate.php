<?php
require 'db.php';
session_start();
//echo $_SESSION['Desg'];
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$_SESSION['type'] = 'Social';
$_SESSION['flag_file'] = 1; 
$people =$_SESSION['people'];
$column = isset($_SESSION['column']) ? $_SESSION['column'] : 'None';
$sort_order = isset($_SESSION['order']) ? $_SESSION['order'] : 'None';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 0;
$print = isset($_SESSION['print']) ? $_SESSION ['print'] : 'Social Work:- All Students';
$sql_search = '';
$sql_dept = '';
if($flag == 1){
    $sql_search = isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';
    
  }
  elseif($flag == 2){
    $sql_dept = isset($_SESSION['sql_dept']) ? $_SESSION['sql_dept'] : '';
  }
  if($flag == 12 || $flag ==21){
    $sql_search = isset($_SESSION['sql_search']) ? $_SESSION['sql_search'] : '';
    $sql_dept = isset($_SESSION['sql_dept']) ? $_SESSION['sql_dept'] : '';
  }
   
    $up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
    $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

    
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Social Work Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,500i,700,800i" rel="stylesheet">
  <link rel="stylesheet" href="../css/NavStyle.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


    <style type="text/css">

th{
  background:#47cad1;
}

th:hover{
     cursor:pointer;
    background:#000;
    
}
th a i {
    color: rgba(255,255,255,0.4);
}
</style>
<!-- Bootstrap CSS -->

<body class="bg-info" style="overflow: scroll">
  
    <nav class="navbar navbar-expand-custom navbar-light darker">
      <?php if($_SESSION['login_flag'] == 3){ ?>
      <a class="navbar-brand gap" href="../Admin_Home.php">Home</a>
      <?php  }else if($_SESSION['login_flag'] == 2){  ?>
        <a class="navbar-brand gap" href="../Authority_Home.php">Home</a>
      <?php } ?>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item gap2">
              <a class="nav-link" href="../students.php">Back</a>
            </li>
            <li class="nav-item gap2">
              <a class="nav-link" href="index.php">Show All Students</a>
            </li>
            <li class="nav-item gap2">
              <a class="nav-link" href="../Graphs.php">Graph Analysis</a>
            </li>


            <li class="nav-item gap2">
            <form class="form" action="dept.php?sql_search=<?php echo urlencode($sql_search)?>" method="post" enctype="multipart/form-data" >
              <?php if($_SESSION['Desg'] != 'HOD' && $_SESSION['Desg'] != 'Class Teacher'){ ?>
           <input list="search1" type="text" name="dept" id="srch1" class="input-field" autocomplete="off" placeholder="Department" required >
            <datalist id="search1">
              <select  name="search1" id="searchs1">
              <option  value="Computer">Computer</option>
              <option  value="IT">IT</option>
              <option  value="ENTC">ENTC</option>
              </select>  
            </datalist><br>
          <?php }if($_SESSION['Desg'] != 'Class Teacher'){ ?>
           <input list="search2" type="text" name="year" id="srch2" class="input-field1" autocomplete="off" placeholder="Year" >
            <datalist id="search2">
              <select name="search2" id="searchs2" >
              <option  value="FE">FE</option>
              <option  value="SE">SE</option>
              <option  value="TE">TE</option>
              <option  value="BE">BE</option>
              </select>  
            </datalist>

            <input name="division" type="number" class="input-field1" placeholder="Div(1/2/3..)" >
         
            <button type="submit" class="form-button extra" ></span><i class="fa fa-search"></i>
              </button>
              <?php }  ?>

              </form>
          </li>

          <li class="nav-item gap2">
          <form class="form" action="search.php?sql_dept=<?php echo urlencode($sql_dept)?>" method="post" enctype="multipart/form-data" >
          <input list="search" name="search" id="srch" onchange="myFunction(this)" class="input-field center" autocomplete="off" placeholder="Search By">
              <datalist id="search">
                <select name="searchs" id="searchs" >
                <option  value="Reg.ID">Reg.ID</option>
                <option  value="Nature_of_work">Nature_of_work</option>
                <option  value="Description">Description</option>
                <option  value="Associated_org">Associated_org</option>
                <option  value="Venue">Venue</option>
                <option  value="Dates">Dates</option>
                </select>     
              </datalist>
            <div class="input-group" id="ID" style="display: none;">
              <input name="regid" type="text" placeholder="Enter Reg. ID" class="input-field">
                <button  type="submit" class="form-button"></span><i class="fa fa-search"></i>
                </button>
            </div> 
            <div id="Spt" style="display: none;">
              <input name="Nature_of_work" type="text" placeholder="Enter Nature Of Work " class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div>
            <div id="Descp" style="display: none;">
              <input name="desc" type="text" placeholder="Enter Description" class="input-field"><br>
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <div id="Associated_org" style="display: none;">
              <input name="Associated_org" type="text" placeholder="Enter Associated_org" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <div id="Ven" style="display: none;">
              <input name="venue" type="text" placeholder="Enter Venue" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <li class="nav-item" >
            <div id="date" style="display: none;">
              <label for="df" class="label">Date From: </label>
              <input id="df_id" type="date" name="df" class="input-field"><br>
              <label for="df" class="label">Date To: &nbsp;&nbsp;&nbsp;&nbsp;</label>
              <input id="dt_id" type="date" name="dt" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
              </div>
          </li>
         </form> 
        </li>
        <li class="gap2">
          <form method="post" action="printpreview.php">
              <button type="submit" class="form-button1">Print Preview</button> 
          </form>
          
        </li>

        <li class="nav-item gap2">
          <?php if($_SESSION['login_flag'] == 2){ ?>
              <a class="nav-link extra" href="../logout_auth.php">Logout</a>
          <?php }else if($_SESSION['login_flag'] == 3){ ?>
              <a class="nav-link extra" href="../logout_admin.php">Logout</a>
          <?php } ?>
         </li>
    </ul>
    
    </div>
  </nav>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('.navbar-light .dmenu').hover(function () {
        $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
    }, function () {
        $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
    });
});
</script>
<script type="text/javascript">
  function myFunction(option){
          var opt = option.value;
          if(opt == "Reg.ID"){
            document.getElementById("ID").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Nature_of_work"){
            document.getElementById("Spt").style.display = "block"; 
            document.getElementById("srch").style.display = "none";       
          }
          if(opt == "Description"){
            document.getElementById("Descp").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Venue"){
            document.getElementById("Ven").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Associated_org"){
            document.getElementById("Associated_org").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Dates"){
            document.getElementById("date").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
      }
</script> 

<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2><?php echo $print ?></h2>
    </div>
    <div class="card-body" style="overflow: scroll;">
      <table class="table table-bordered">
       <thead>
        <tr style="font-size: 14.3px;">
          <th style="width: 130px;" >
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="ID">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Reg. ID<i class="fas fa-sort<?php echo $column == 'ID' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Rollno">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Roll No<i class="fas fa-sort<?php echo $column == 'Rollno' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Year">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>"><a href="session_m.php" onclick="this.closest('form').submit();return false;">Year<i class="fas fa-sort<?php echo $column == 'Year' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>
          <th>
          <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Nature_of_work">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Nature Of Work <i class="fas fa-sort<?php echo $column == 'Nature_of_work' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
        </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Description">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Description<i class="fas fa-sort<?php echo $column == 'Description' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Associated_org">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Associated_org<i class="fas fa-sort<?php echo $column == 'Associated_org' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form> 
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Venue">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Venue<i class="fas fa-sort<?php echo $column == 'Venue' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Date_SW">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Date of Occasion<i class="fas fa-sort<?php echo $column == 'Date_SW' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>
          <th>Certificate</th>
        </tr>
       </thead>  
       <tbody>
        <?php foreach($people as $person): ?>
          <tr>
            <td><b>
              <form class="stu" action="../stu_profile/view_profile.php" method="post">
              <input type="hidden" name="id" value="<?php echo urlencode($person->ID)?>" />
              <a href="../stu_profile/view_profile.php"onclick="this.closest('form').submit();return false;" ><?php echo urlencode($person->ID)?></a>
              </form>
            <td><?= $person->Rollno; ?></td>
            <td><?= $person->Year; ?></td>
            <td><?= $person->Nature_of_work; ?></td>
            <td><?= $person->Description; ?></td>
            <td><?= $person->Associated_org; ?></td>
            <td><?= $person->Venue; ?></td>
            <td><?= $person->Date_SW; ?></td>   
            <td><a href="../file/solo_download.php?ID=<?php echo $person->ID?>&uid=<?php echo $person->UID?>" style="margin:5%;font-size: 14px;" >Download</a></td>
          </tr>
        <?php endforeach; ?>
       </tbody>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; 
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
           
            




