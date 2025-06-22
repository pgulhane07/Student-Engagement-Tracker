<?php
require 'db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
$id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
$_SESSION['type'] = 'formG';
$_SESSION['flag_file'] = 2; 
$people =$_SESSION['people'];
$column = isset($_SESSION['column']) ? $_SESSION['column'] : 'None';
$sort_order = isset($_SESSION['order']) ? $_SESSION['order'] : 'None';
$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 0;
$print = isset($_SESSION['print']) ? $_SESSION ['print'] : 'FormG:- All Teachers';
$sql_search = '';
$sql_dept = '';
$_SESSION['flag'] = $flag;
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
    <title>FormG Information</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,500i,700,800i" rel="stylesheet">
  <link rel="stylesheet" href="../../../css/NavStyle.css">
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
  </head>
  <body class="bg-info" style="overflow: scroll">
  
    <nav class="navbar navbar-expand-custom navbar-light darker">
      <?php if($_SESSION['login_flag'] == 3){ ?>
      <a class="navbar-brand gap" href="../../../Admin_Home.php">Home</a>
      <?php  }else if($_SESSION['login_flag'] == 2){  ?>
        <a class="navbar-brand gap" href="../../../Authority_Home.php">Home</a>
      <?php } ?>
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item gap2">
              <a class="nav-link" href="../../../teachers.php">Back</a>
            </li>
            <?php if(isset($_SESSION['CH'])){  ?>
              <li class="nav-item gap2">
              <a class="nav-link" href="create.php">Add Achievement</a>
            </li>
            <?php } ?>
            <li class="nav-item gap2">
              <a class="nav-link" href="index.php">Show All Teachers</a>
            </li>
      
           
          <li class="nav-item gap2">
            <form class="form" action="dept.php?sql_search=<?php echo urlencode($sql_search)?>" method="post" enctype="multipart/form-data" >
              <?php if($_SESSION['login_flag'] == 3 || $_SESSION['Desg'] == 'Principal'){ ?>
           <input list="search1" type="text" name="dept" id="srch1" class="input-field" autocomplete="off" placeholder="Department" required >
            <datalist id="search1">
              <select  name="search1" id="searchs1">
              <option  value="Computer">Computer</option>
              <option  value="IT">IT</option>
              <option  value="ENTC">ENTC</option>
              </select>  
            </datalist>
           
            <button type="submit" class="form-button extra" ></span><i class="fa fa-search"></i>
              </button>
              <?php } ?>
        </form>
          </li>

          <li class="nav-item gap2">
          <form class="form" action="search.php?sql_dept=<?php echo urlencode($sql_dept)?>" method="post" enctype="multipart/form-data" >
          <input list="search" name="search" id="srch" onchange="myFunction(this)" class="input-field center" autocomplete="off" placeholder="Search By">
              <datalist id="search">
                <select name="searchs" id="searchs" >
                <option  value="Reg.ID">Reg.ID</option>  
                <option  value="Name">Name</option>
                <option  value="Grantname">Grantname</option>
                <option  value="Authority">Authority</option>
                <option  value="Period">Period</option>
                <option  value="OrderNo">OrderNo</option>
                <option  value="Amount">Amount</option>
                <!-- <option  value="Filename">Filename</option> -->
                <option  value="Dates">Dates</option>
                </select>     
              </datalist>
            <div class="input-group" id="id" style="display: none;">
              <input name="regid" type="text" placeholder="Enter Reg.ID" class="input-field">
                <button  type="submit" class="form-button"></span><i class="fa fa-search"></i>
                </button>
            </div>  
            <div class="input-group" id="Name" style="display: none;">
              <input name="Name" type="text" placeholder="Enter Name" class="input-field">
                <button  type="submit" class="form-button"></span><i class="fa fa-search"></i>
                </button>
            </div> 
            <div id="Grantname" style="display: none;">
              <input name="Grantname" type="text" placeholder="Enter Grantname" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div>
            <div id="Authority" style="display: none;">
              <input name="Authority" type="text" placeholder="Enter Authority" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <div id="Period" style="display: none;">
              <input name="Period" type="text" placeholder="Enter Period" class="input-field">
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <div id="Order" style="display: none;">
              <input name="OrderNo" type="text" placeholder="Enter Order number" class="input-field"><br>
              <button type="submit" class="form-button" ></span><i class="fa fa-search"></i>
              </button>
            </div> 
            <div id="Amount" style="display: none;">
              <input name="Amount" type="text" placeholder="Enter Amount" class="input-field"><br>
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
              <?php if($_SESSION['login_flag'] == 3){ ?>
          <a class="nav-link extra" href="../../../logout_admin.php">Logout</a>
          <?php  }else if($_SESSION['login_flag'] == 2){  ?>
            <a class="nav-link extra" href="../../../logout_auth.php">Logout</a>
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
            document.getElementById("id").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Name"){
            document.getElementById("Name").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Grantname"){
            document.getElementById("Grantname").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Authority"){
            document.getElementById("Authority").style.display = "block"; 
            document.getElementById("srch").style.display = "none";       
          }
          if(opt == "Period"){
            document.getElementById("Period").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "OrderNo"){
            document.getElementById("Order").style.display = "block";
            document.getElementById("srch").style.display = "none";
          }
          if(opt == "Amount"){
            document.getElementById("Amount").style.display = "block";
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
        <?php if(isset($_SESSION['CH'])){  ?>
          <th> </th>
          <?php } ?>
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
            <input type="hidden" name="column" value="Name">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Name<i class="fas fa-sort<?php echo $column == 'Name' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Grantname">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Grantname<i class="fas fa-sort<?php echo $column == 'Grantname' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Authority">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Authority<i class="fas fa-sort<?php echo $column == 'Authority' ? '-' . $up_or_down : ''; ?>"></i></a>
          </form>
        </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Period">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Period Authority<i class="fas fa-sort<?php echo $column == 'Period' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="OrderNo">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">OrderNo<i class="fas fa-sort<?php echo $column == 'OrderNo' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>
          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Amount">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Amount<i class="fas fa-sort<?php echo $column == 'Amount' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form> 
          </th>

          <th>
            <form action="session_m.php" method="post">
            <input type="hidden" name="column" value="Date_start">
            <input type="hidden" name="order" value="<?php echo $asc_or_desc?>">
            <input type="hidden" name="flag" value="<?php echo $flag ?>">
            <a href="session_m.php" onclick="this.closest('form').submit();return false;">Start Date<i class="fas fa-sort<?php echo $column == 'Date_start' ? '-' . $up_or_down : ''; ?>"></i></a>
            </form>
          </th>

          <th>Certificate</th>
        </tr>
       </thead>  
       <tbody>
        <?php foreach($people as $person): ?>
          <tr>
          <?php if(isset($_SESSION['CH'])){  ?>
            <td>
              <form action='session_m.php' method='post'>
                  <input type='hidden' name='uid1' value='<?php echo $person->UID;?>' />
                  <input type='hidden' name='aid' value='<?php echo $person->ID;?>' />
                  <button class="btn btn-info" onClick='submit();'>Edit</button>  
              </form>
            </td>  
            <?php } ?>
            <td><b>
              <form class="stu" action="../../../teacher_profile/view_profile.php" method="post">
              <input type="hidden" name="id" value="<?php echo urlencode($person->ID)?>" />
              <a href="../../../teacher_profile/view_profile.php"onclick="this.closest('form').submit();return false;" ><?php echo urlencode($person->ID)?></a>
              </form>
              <td><?= $person->Name; ?></td> 
            <td><?= $person->Grantname; ?></td>
            <td><?= $person->Authority; ?></td>
            <td><?= $person->Period; ?></td>
            <td><?= $person->OrderNo; ?></td>
            <td><?= $person->Amount; ?></td>
            <td><?= $person->Date_start; ?></td>   
            <td><a href="../../../file/solo_download.php?ID=<?php echo $person->ID?>&uid=<?php echo $person->UID?>" style="margin:5%;font-size: 14px;" >Download</a></td>
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
        header("location: ../../../Authority_login.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../../../Admin_login.html");
        exit;
    }

}
?>
