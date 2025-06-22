<?php require '../db.php';
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login"]) || $_SESSION["login"] == true ||  isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

		$id = isset($_POST['id']) ? $_POST['id'] : $_SESSION['ID'];
		$frm = isset($_POST['frm']) ? $_POST['frm'] : '';
		$fn = isset($_POST['fn']) ? $_POST['fn'] : '';
    $flag = 0;
    if($_SESSION['login_flag'] == 3){
      $flag = 1;
    }
    else if($_SESSION['login_flag'] == 2){
      $flag = 2;
    }


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
<html >
  <head>
    <title class="control-group">Preview</title> 
    <link rel="stylesheet" type="text/css" href="../css/print.css" media="print" />
    <link rel="stylesheet" type="text/css" href="../css/printpreview.css"  />
    
   </head>
  <body >
    <?php if($_SESSION['login_flag'] == 3){ ?>
      <a class="control-group" href="../Admin_Home.php"><b>Home</b></a>   
    <?php }else if($_SESSION['login_flag'] == 1){ ?>
      <a class="control-group" href="../Student_Home.php"><b>Home</b></a>
    <?php }else if($_SESSION['login_flag'] == 2){ ?>
      <a class="control-group" href="../Authority_Home.php"><b>Home</b></a>
    <?php } ?>
      <form action="view_profile.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <a href="view_profile.php" onclick="this.closest('form').submit();return false;"><b>Go Back</b></a>
      </form>

  	
  <div style="padding-left:10%;">
    <center>
    <text style="font-size: 30px;"><b>Report : <?php echo $id?>. <?php echo $fn?>  </b>
    </text></center>
    <hr>

    <?php  if($frm == 'Arts' || $frm == 'All'){  ?>

    <div class="tabs" >
          <h2>Arts</h2>
      <table>

        <tr>
          <th scope="col">Sr. No.</th>
          <th scope="col">Reg. ID</th>
          <th scope="col">Type of Art</th>
          <th scope="col">Description</th>
          <th scope="col">Venue</th>
          <th scope="col">Achievements</th>
          <th scope="col">Date(Y-M-D)</th>
           
        </tr>
         <?php if (mysqli_num_rows($result3) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result3)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td scope="row"><?php echo $row ['ID'];?></td>
            <td scope="row"><?php echo $row ['Art_Type'];?></td>
            <td scope="row"><?php echo $row ['Description'];?> </td>
            <td scope="row"><?php echo $row ['Venue'];?></td>
            <td scope="row"><?php echo $row ['Achievements'];?></td>
            <td scope="row"><?php echo $row ['Date_Arts'];?></td>               
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

  <?php  if($frm == 'Comp' || $frm == 'All'){  ?>
  	<br><br>
    <div class="tabs" >
          <h2>Competitive Coding</h2>
      <table>

        <tr>
          <th scope="col">Sr. No.</th>
          <th scope="col">Reg. ID</th>
          <th scope="col">Event</th>
          <th scope="col">Description</th>
          <th scope="col">Venue</th>
          <th scope="col">Achievements</th>
          <th scope="col">Date(Y-M-D)</th>
        </tr>
         <?php if (mysqli_num_rows($result4) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result4)){
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

  <?php  if($frm == 'Internship' || $frm == 'All'){  ?>
    <br><br>
    <div class="tabs" >
          <h2>Internship</h2>
      <table>

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
        </tr>
         <?php if (mysqli_num_rows($result6) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result6)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td scope="row"><?php echo $cnt?></td>
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

  <?php  if($frm == 'Paper' || $frm == 'All'){  ?>
    <br><br>
    <div class="tabs" >
          <h2>Paper Presentation</h2>
      <table>

        <tr>
          <th scope="col">Sr. No.</th>
          <th scope="col">Reg.ID</th>
          <th scope="col">Title</th>
          <th scope="col">Domain</th>
          <th scope="col">Guide</th>
          <th scope="col">Organisation</th>
          <th scope="col">Date(Y-M-D)</th>
        </tr>
         <?php if (mysqli_num_rows($result7) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result7)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td scope="row"><?php echo $cnt?></td>
            <td scope="row"><?php echo $row ['ID'];?></td>
            <td scope="row"><?php echo $row ['Title'];?></td>
            <td scope="row"><?php echo $row ['Domain'];?></td>

            <td scope="row"><?php echo $row ['Guide'];?></td>
            <td scope="row"><?php echo $row ['Organisation_publish'];?></td>
            <td scope="row"><?php echo $row ['Date_publish'];?></td> 
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

  <?php  if($frm == 'Project' || $frm == 'All'){  ?>
    <br><br>
    <div class="tabs" >
          <h2>Project Competition</h2>
      <table>

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
        </tr>
         <?php if (mysqli_num_rows($result8) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result8)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
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

  <?php  if($frm == 'SW' || $frm == 'All'){  ?>
  	<br><br>
    <div class="tabs" >
          <h2>Social Work</h2>
      <table>

        <tr>
		  <th scope="col">Sr. No.</th>
          <th scope="col">Reg. ID</th>
          <th scope="col">Nature_of_work</th>
          <th scope="col">Description</th>
          <th scope="col">Associated Organisation</th>
          <th scope="col">Venue</th>
          <th scope="col">Date(Y-M-D)</th>
        </tr>
         <?php if (mysqli_num_rows($result5) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result5)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
            <td scope="row"><?php echo $row ['ID'];?></td>
            <td scope="row"><?php echo $row ['Nature_of_work'];?></td>
            <td scope="row"><?php echo $row ['Description'];?></td>
            <td scope="row"><?php echo $row ['Associated_org'];?></td>
            <td scope="row"><?php echo $row ['Venue'];?></td>
            <td scope="row"><?php echo $row ['Date_SW'];?></td>	
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

  <?php  if($frm == 'Sports' || $frm == 'All'){  ?>
  	<br><br>
    <div class="tabs" >
          <h2>Sports</h2>
      <table>

        <tr>
          <th scope="col">Sr. No.</th>
          <th scope="col">Reg. ID</th>
          <th scope="col">Sports Name</th>
          <th scope="col">Description</th>
          <th scope="col">Venue</th>
          <th scope="col">Achievements</th>
          <th scope="col">Date(Y-M-D)</th>
        </tr>
         <?php if (mysqli_num_rows($result2) > 0) {
            $cnt=0;
        while ($row = mysqli_fetch_array ($result2)){
            $cnt=$cnt+1;
       ?>
        <tr>
            <td><?php echo $cnt?></td>  
			<td scope="row"><?php echo $row ['ID'];?></td>
            <td scope="row"><?php echo $row ['Sports_Name'];?></td>
            <td scope="row"><?php echo $row ['Description'];?></td>
            <td scope="row"><?php echo $row ['Venue'];?></td>
            <td scope="row"><?php echo $row ['Achievements'];?></td>
            <td scope="row"><?php echo $row ['Date_Sports'];?></td>	
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