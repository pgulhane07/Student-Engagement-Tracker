<?php
require 'db.php';
session_start();

if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){
	
if (isset ($_POST['sdate'])  && isset($_POST['edate']) && isset($_POST['form']) && isset($_POST['month'])  ) {
  
  $month = $_POST['month'];
  $rawdate1 = $_POST['sdate'];
  $rawdate2 = $_POST['edate'];
  $dept = $_SESSION["Dept"];
  $rf = isset($_POST['rf']) ? $_POST['rf'] : '';
  $rt = isset($_POST['rt']) ? $_POST['rt'] : '';
  $dept = isset($_SESSION['Dept']) ? $_SESSION['Dept'] : $_SESSION['Dept'];
  $cid = isset($_SESSION['CID']) ? $_SESSION['CID'] : '';
  $dpt = isset($_POST['dept']) ? $_POST['dept'] : '';
  if($dpt != 'All'){
    $dept = $dpt;
  }
  $form = $_POST['form'];
  $start = date('Y-m-d',strtotime($rawdate1));
  $end = date('Y-m-d',strtotime($rawdate2));
  //echo $start;
 
  if(($_SESSION["login_flag"] == 3 && $dpt == 'All') || ($_SESSION["login_flag"] == 2 && $_SESSION["Desg"] == 'Principal')){

  $sql1 = "SELECT * FROM arts WHERE Date_Arts BETWEEN '$start' AND '$end'";
 	$result1 = mysqli_query ($conn,$sql1) or die ('Error');

 	$sql2 = "SELECT * FROM competitive WHERE Date_comp BETWEEN '$start' AND '$end'";
 	$result2 = mysqli_query ($conn,$sql2) or die ('Error');

 	$sql3 = "SELECT * FROM internship WHERE Date_Join BETWEEN '$start' AND '$end'";
 	$result3 = mysqli_query ($conn,$sql3) or die ('Error');

 	$sql4 = "SELECT * FROM paper_presentation WHERE Date_publish BETWEEN '$start' AND '$end'";
 	$result4 = mysqli_query ($conn,$sql4) or die ('Error');

 	$sql5 = "SELECT * FROM project_competition WHERE Date_Proj BETWEEN '$start' AND '$end'";
 	$result5 = mysqli_query ($conn,$sql5) or die ('Error');

 	$sql6 = "SELECT * FROM social_work WHERE Date_SW BETWEEN '$start' AND '$end'";
 	$result6 = mysqli_query ($conn,$sql6) or die ('Error');

 	$sql7 = "SELECT * FROM sports WHERE Date_Sports BETWEEN '$start' AND '$end'";
 	$result7 = mysqli_query ($conn,$sql7) or die ('Error');

}

else if(($_SESSION["login_flag"] == 3 && $dpt != 'All') || ($_SESSION["login_flag"] == 2 && $_SESSION["Desg"] == 'HOD')){

	$sql1 = "SELECT s.* FROM arts s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
	//echo $sql1;
 	$result1 = mysqli_query ($conn,$sql1) or die ('Error');

 	$sql2 = "SELECT s.* FROM competitive s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
 	$result2 = mysqli_query ($conn,$sql2) or die ('Error');

 	$sql3 = "SELECT s.* FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
 	$result3 = mysqli_query ($conn,$sql3) or die ('Error');

 	$sql4 = "SELECT s.* FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
 	$result4 = mysqli_query ($conn,$sql4) or die ('Error');

 	$sql5 = "SELECT s.* FROM project_competition s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
 	$result5 = mysqli_query ($conn,$sql5) or die ('Error');

 	$sql6 = "SELECT s.* FROM social_work s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
 	$result6 = mysqli_query ($conn,$sql6) or die ('Error');

 	$sql7 = "SELECT s.* FROM sports s INNER JOIN Student st ON s.ID = st.ID WHERE st.Department ='$dept'";
 	$result7 = mysqli_query ($conn,$sql7) or die ('Error');
}

else if($_SESSION["login_flag"] == 2 && $_SESSION["Desg"] == 'Class Teacher' && !isset($_POST['rf']) ){

	$sql1 = "SELECT s.* FROM arts s INNER JOIN Student st ON s.ID = st.ID WHERE s.ClassID ='$cid'";
	//echo $sql1;
 	$result1 = mysqli_query ($conn,$sql1) or die ('Error');

 	$sql2 = "SELECT s.* FROM competitive s INNER JOIN Student st ON s.ID = st.ID WHERE s.ClassID ='$cid'";
 	$result2 = mysqli_query ($conn,$sql2) or die ('Error');

 	$sql3 = "SELECT s.* FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE s.ClassID ='$cid'";
 	$result3 = mysqli_query ($conn,$sql3) or die ('Error');

 	$sql4 = "SELECT s.* FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE s.ClassID ='$cid'";
 	$result4 = mysqli_query ($conn,$sql4) or die ('Error');

 	$sql5 = "SELECT s.* FROM project_competition s INNER JOIN Student st ON s.ID = st.ID WHERE s.ClassID ='$cid'";
 	$result5 = mysqli_query ($conn,$sql5) or die ('Error');

 	$sql6 = "SELECT s.* FROM social_work s INNER JOIN Student st ON s.ID = st.ID WHERE s.ClassID ='$cid'";
 	$result6 = mysqli_query ($conn,$sql6) or die ('Error');

 	$sql7 = "SELECT s.* FROM sports s INNER JOIN Student st ON s.ID = st.ID WHERE s.ClassID ='$cid'";
 	$result7 = mysqli_query ($conn,$sql7) or die ('Error');
}

else if($_SESSION["login_flag"] == 2 && $_SESSION["Desg"] == 'Class Teacher' && $_SESSION['mentor'] == true && isset($_POST['rf'])){

	$sql1 = "SELECT s.* FROM arts s INNER JOIN Student st ON s.ID = st.ID WHERE st.Rollno BETWEEN '$rf' AND '$rt'";
	//echo $sql1;
 	$result1 = mysqli_query ($conn,$sql1) or die ('Error');

 	$sql2 = "SELECT s.* FROM competitive s INNER JOIN Student st ON s.ID = st.ID WHERE st.Rollno BETWEEN '$rf' AND '$rt'";
 	$result2 = mysqli_query ($conn,$sql2) or die ('Error');

 	$sql3 = "SELECT s.* FROM internship s INNER JOIN Student st ON s.ID = st.ID WHERE st.Rollno BETWEEN '$rf' AND '$rt'";
 	$result3 = mysqli_query ($conn,$sql3) or die ('Error');

 	$sql4 = "SELECT s.* FROM paper_presentation s INNER JOIN Student st ON s.ID = st.ID WHERE st.Rollno BETWEEN '$rf' AND '$rt'";
 	$result4 = mysqli_query ($conn,$sql4) or die ('Error');

 	$sql5 = "SELECT s.* FROM project_competition s INNER JOIN Student st ON s.ID = st.ID WHERE st.Rollno BETWEEN '$rf' AND '$rt'";
 	$result5 = mysqli_query ($conn,$sql5) or die ('Error');

 	$sql6 = "SELECT s.* FROM social_work s INNER JOIN Student st ON s.ID = st.ID WHERE st.Rollno BETWEEN '$rf' AND '$rt'";
 	$result6 = mysqli_query ($conn,$sql6) or die ('Error');

 	$sql7 = "SELECT s.* FROM sports s INNER JOIN Student st ON s.ID = st.ID WHERE st.Rollno BETWEEN '$rf' AND '$rt'";
 	$result7 = mysqli_query ($conn,$sql7) or die ('Error');
}
  
  
}


?>

<html >
  <head>
    <title class="control-group">Preview</title> 
    <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="../css/printpreview.css"  />
    
 </head>
  <body >

    

  <div class="logo" style="padding-left:10%;">
    <?php if($_SESSION['login_flag'] == 2){ ?>
    <a class="control-group" href="../Authority_Home.php"><b>Go Back</b></a>
    <?php }else if($_SESSION['login_flag'] == 3){ ?>
    <a class="control-group" href="../Admin_Home.php"><b>Go Back</b></a>
    <?php } ?>


    <p  style="padding-left:100px;font-size: 40px;"><b>Monthly Report for <?php echo $month?>  </b></p>
    <?php if($_SESSION['login_flag'] == 3){ ?>
    <p  style="padding-left:100px;font-size: 25px;"><b>Department : <?php echo $dpt?>  </b></p>
    <?php } ?>
    <hr>

    <p  style="padding-left:140px;font-size: 20px;"><b>Record between  <?php echo $rawdate1?> and <?php echo $rawdate2?>  </b></p>
    </div>

    <?php  if($form == 'Arts' || $form == 'All'){  ?> 

    <div class="tabs" >
          <h2>Arts</h2>
      <table>

        <tr>
          <th>Sr. No.</th>
          <th>Reg.ID</th>
          <th>Type</th>
          <th>Description</th>
          <th>Location</th>
          <th>Achievements</th>
          <th>Date(Y-M-D)</th>
           
        </tr>
         <?php if (mysqli_num_rows($result1) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result1)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td><?php echo $row ['ID'];?></td>
            <td><?php echo $row ['Art_Type'];?></td>
            <td><?php echo $row ['Description'];?></td>
            <td><?php echo $row ['Venue'];?></td>
            <td><?php echo $row ['Achievements'];?></td>
            <td><?php echo $row ['Date_Arts'];?></td>
        </tr>
         <?php }
        } else {
          $cnt=0;
          ?>

         <tr>
            <td><?php echo $cnt?></td>   
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>           
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
        </tr>
          <?php
          
      } ?>
            
      </table>
      </div>

      <?php  } ?>

    <?php  if($form == 'Competitive Coding' || $form == 'All'){  ?>

    <br><br>

    <div class="tabs" >
          <h2>Competitive Coding</h2>
      <table  >

        <tr>
          <th>Sr. No.</th>
          <th>Reg.ID</th>
          <th>Event</th>
          <th>Description</th>
          <th>Location</th>
          <th>Achievements</th>
          <th>Date(Y-M-D)</th>
           
        </tr>
         <?php if (mysqli_num_rows($result2) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result2)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td><?php echo $row ['ID'];?></td>
            <td><?php echo $row ['Event'];?></td>
            <td><?php echo $row ['Description'];?></td>
            <td><?php echo $row ['Venue'];?></td>
            <td><?php echo $row ['Achievements'];?></td>
            <td><?php echo $row ['Date_comp'];?></td>
        </tr>
         <?php }
        } else {
          $cnt=0;
          ?>

         <tr>
            <td><?php echo $cnt?></td>   
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>           
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
        </tr>
          <?php
          
      } ?>
            
      </table>
      </div>

      <?php  } ?>

    <?php  if($form == 'Internships' || $form == 'All'){  ?>

    <br><br>

    <div class="tabs" >
          <h2>Internship</h2>
      <table  >

        <tr>
          <th>Sr. No.</th>
          <th>Reg.ID</th>
          <th>Company</th>
          <th>Company Address</th>
          <th>Duration</th>
          <th>Type</th>
          <th>Job Role</th>
          <th>Description</th>
          <th>Stipend</th>
          <th>Source</th>
          <th>Approval</th>
          <th>Join Date(Y-M-D)</th>
          <th>End Date(Y-M-D)</th>
           
        </tr>
         <?php if (mysqli_num_rows($result3) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result3)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td><?php echo $row ['ID'];?></td>
            <td><?php echo $row ['Company'];?></td>
            <td><?php echo $row ['Address'];?></td>
            <td><?php echo $row ['Duration'];?></td>
            <td><?php echo $row ['Type'];?></td>
            <td><?php echo $row ['Job_Role'];?></td>
            <td><?php echo $row ['Description'];?></td>
            <td><?php echo $row ['Stipend'];?></td>
            <td><?php echo $row ['Source'];?></td>
            <td><?php echo $row ['Approve'];?></td>
            <td><?php echo $row ['Date_Join'];?></td>
            <td><?php echo $row ['Date_End'];?></td>
        </tr>
         <?php }
        } else {
          $cnt=0;
          ?>

         <tr>
            <td><?php echo $cnt?></td>   
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>           
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>           
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
        </tr>
          <?php
          
      } ?>
            
      </table>
      </div>

      <?php  } ?>

    <?php  if($form == 'Paper Presentation' || $form == 'All'){  ?>

    <br><br>

    <div class="tabs" >
          <h2>Paper Presentation</h2>
      <table  >

        <tr>
          <th>Sr. No.</th>
          <th>Reg.ID</th>
          <th>Title</th>
          <th>Domain</th>
          <th>Guide</th>
          <th>Organisation</th>
          <th>Date(Y-M-D)</th>
           
        </tr>
         <?php if (mysqli_num_rows($result4) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result4)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td><?php echo $row ['ID'];?></td>
            <td><?php echo $row ['Title'];?></td>
            <td><?php echo $row ['Domain'];?></td>
            <td><?php echo $row ['Guide'];?></td>
            <td><?php echo $row ['Organisation_publish'];?></td>
            <td><?php echo $row ['Date_publish'];?></td>
        </tr>
         <?php }
        } else {
          $cnt=0;
          ?>

         <tr>
            <td><?php echo $cnt?></td>   
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>           
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
        </tr>
          <?php
          
      } ?>
            
      </table>
      </div>

      <?php  } ?>

    <?php  if($form == 'Project Competition' || $form == 'All'){  ?>

    <br><br>

    <div class="tabs" >
          <h2>Project Competition</h2>
      <table>

        <tr>
          <th>Sr. No.</th>
          <th>Reg.ID</th>
          <th>Title</th>
          <th>Domain</th>
          <th>Type</th>
          <th>Description</th>
          <th>Guide</th>
          <th>Sponsorship</th>
          <th>Achievement</th>
          <th>Location</th>
          <th>Date(Y-M-D)</th>
           
        </tr>
         <?php if (mysqli_num_rows($result5) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result5)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td><?php echo $row ['ID'];?></td>
            <td><?php echo $row ['Title'];?></td>
            <td><?php echo $row ['Domain'];?></td>
            <td><?php echo $row ['Type'];?></td>
            <td><?php echo $row ['Description'];?></td>
            <td><?php echo $row ['Guide'];?></td>
            <td><?php echo $row ['Sponsor'];?></td>
            <td><?php echo $row ['Achievement'];?></td>
            <td><?php echo $row ['Venue'];?></td>
            <td><?php echo $row ['Date_Proj'];?></td>
        </tr>
         <?php }
        } else {
          $cnt=0;
          ?>

         <tr>
            <td><?php echo $cnt?></td>   
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>           
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
        </tr>
          <?php
          
      } ?>
            
      </table>
      </div>

      <?php  } ?>

    <?php  if($form == 'Social Work' || $form == 'All'){  ?>

    <br><br>

    <div class="tabs" >
          <h2>Social Work</h2>
      <table  >

        <tr>
          <th>Sr. No.</th>
          <th>Reg.ID</th>
          <th>Work</th>
          <th>Description</th>
          <th>Organisation</th>
          <th>Location</th>          
          <th>Date(Y-M-D)</th>
           
        </tr>
         <?php if (mysqli_num_rows($result6) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result6)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td><?php echo $row ['ID'];?></td>
            <td><?php echo $row ['Nature_of_work'];?></td>
            <td><?php echo $row ['Description'];?></td>
            <td><?php echo $row ['Associated_org'];?></td>
            <td><?php echo $row ['Venue'];?></td>
            <td><?php echo $row ['Date_SW'];?></td>
        </tr>
         <?php }
        } else {
          $cnt=0;
          ?>

         <tr>
            <td><?php echo $cnt?></td>   
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>           
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
        </tr>
          <?php
          
      } ?>
            
      </table>
      </div>

      <?php  } ?>

    <?php  if($form == 'Sports' || $form == 'All'){  ?>

    <br><br>

    <div class="tabs" >
          <h2>Sports</h2>
      <table  >

        <tr>
          <th>Sr. No.</th>
          <th>Reg.ID</th>
          <th>Sports Name</th>
          <th>Description</th>
          <th>Achievements</th>
          <th>Venue</th>
          <th>Date(Y-M-D)</th>
           
        </tr>
         <?php if (mysqli_num_rows($result7) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result7)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td><?php echo $row ['ID'];?></td>
            <td><?php echo $row ['Sports_Name'];?></td>
            <td><?php echo $row ['Description'];?></td>
            <td><?php echo $row ['Achievements'];?></td>
            <td><?php echo $row ['Venue'];?></td>
            <td><?php echo $row ['Date_Sports'];?></td>
        </tr>
         <?php }
        } else {
          $cnt=0;
          ?>

         <tr>
            <td><?php echo $cnt?></td>   
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>           
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
            <td><?php echo "Nil";?></td>
        </tr>
          <?php
          
      } ?>
            
      </table>
      </div>
      <?php  } ?>

<div style="padding-left: 35%;padding-top: 50px;padding-bottom: 100px">
<button class="control-group" onclick="window.print()"><b>Print Report</b></button>
</div>

</body>
</html>
 









<?php }else{
  if($_SESSION['login_flag'] == 2){
    header("location: ../index.html");
    exit;
  }elseif($_SESSION['login_flag'] == 3){
    header("location: ../Admin_login.html");
    exit;
  }
  
}
?>