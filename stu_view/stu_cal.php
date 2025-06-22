<?php
require 'db.php';
session_start();
//echo $_SESSION['Desg'];
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$_SESSION['flag_file'] = 1; 
$people =$_SESSION['people'];
$column = isset($_SESSION['column']) ? $_SESSION['column'] : 'None';
$sort_order = isset($_SESSION['order']) ? $_SESSION['order'] : 'None';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 0;
$print = isset($_SESSION['print']) ? $_SESSION ['print'] : 'All Students';
$sql_search = '';
$sql_dept = '';
$_SESSION['flag']=$flag;
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
    <title>All Student Information</title>
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
    
  </head>
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
              <a class="nav-link" href="index.php">Show All Students</a>
            </li>
          <li class="nav-item gap2">
            <form class="form" action="stu_dept.php?sql_search=<?php echo urlencode($sql_search)?>" method="post" enctype="multipart/form-data" >
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

           <?php if($_SESSION['mentor'] != true){ ?>
          <li class="nav-item gap2">
          <form class="form" action="stu_search.php?sql_dept=<?php echo urlencode($sql_dept)?>" method="post" enctype="multipart/form-data" >
          <input list="search" name="search" id="srch" onchange="myFunction(this)" class="input-field center" autocomplete="off" placeholder="Search By">
              <datalist id="search">
                <select name="searchs" id="searchs" >
                <option  value="Reg.ID">Reg.ID</option>
                <option  value="Full_Name">Full_Name</option>
                <option  value="Rollno">Rollno</option>
                <option  value="Email">Email</option>
                <option  value="Mobile">Mobile</option>
                <option  value="DOB">DOB</option>
              
                
                </select>     
              </datalist>
            <div class="input-group" id="ID" style="display: none;">
              <input name="regid" type="text" placeholder="Enter Reg. ID" class="input-field">
                <button  type="submit" class="form-button"></span><i class="fa fa-search"></i>
                </button>
            </div> 
            <div id="Full_Name" style="display: none;">
              <input name="Full_Name" type="text" placeholder="Enter Full Name" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div>
            <div id="Rollno" style="display: none;">
              <input name="Rollno" type="text" placeholder="Enter Roll No" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <div id="Email" style="display: none;">
              <input name="Email" type="text" placeholder="Enter Email id" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <div id="Mobile" style="display: none;">
              <input name="Mobile" type="text" placeholder="Enter Mobile No" class="input-field"><br>
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <li class="nav-item" >
            <div id="date" style="display: none;width: 200px;">
            <label for="dt">Date of Birth:-</label>
            <input id="dt_id" type="date" name="dt">
            <button type="submit" value="Search1">Search&ensp;</button>
          </div>
          </li>
         </form> 
        </li>
        <li class="gap2">
          <form method="post" action="printpreview.php">
              <button type="submit" class="form-button1">Print Preview</button> 
          </form>
          
        </li>
        <?php }  ?>

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
          if(opt == "Full_Name"){
            document.getElementById("Full_Name").style.display = "block"; 
            document.getElementById("srch").style.display = "none";       
          }
          if(opt == "Rollno"){
            document.getElementById("Rollno").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Email"){
            document.getElementById("Email").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Mobile"){
            document.getElementById("Mobile").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "DOB"){
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
            <input type="hidden" name="column" value="Full_Name">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Full Name<i class="fas fa-sort<?php echo $column == 'Full_Name' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
        </th>

        <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Class">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Class<i class="fas fa-sort<?php echo $column == 'Class' ? '-' . $up_or_down : ''; ?>"></i></a>
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
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Year<i class="fas fa-sort<?php echo $column == 'Year' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>

          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Department">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Department<i class="fas fa-sort<?php echo $column == 'Department' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>

          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="DOB">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">DOB<i class="fas fa-sort<?php echo $column == 'DOB' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>

          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Email">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Email<i class="fas fa-sort<?php echo $column == 'Email' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>

          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Mobile">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Mobile<i class="fas fa-sort<?php echo $column == 'Mobile' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>

          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Address">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Address<i class="fas fa-sort<?php echo $column == 'Address' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form> 
          </th>
          
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
            <td><?= $person->Full_Name; ?></td>
            <td><?= $person->Class; ?></td>
            <td><?= $person->Rollno; ?></td>
            <td><?= $person->Year; ?></td>
            <td><?= $person->Department; ?></td>    
            <td><?= $person->DOB; ?></td> 
            <td><?= $person->Email; ?></td> 
            <td><?= $person->Mobile; ?></td> 
            <td><?= $person->Address; ?></td>  
          </tr>
        <?php endforeach; ?>
       </tbody>
      </table>
    </div>
  </div>
</div>
<?php require 'footer.php'; 
  }
  else{
    if($_SESSION['login_flag'] == 2){
        header("location: ../indec.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../Admin_login.html");
        exit;
    }

}
?>
