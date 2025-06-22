<?php
session_start();
if(isset($_POST['cls']) && isset($_POST['bct'])){
  $_SESSION['cls'] =  $_POST['cls'];
  $_SESSION['bct'] = $_POST['bct'];
  header("Location: edit.php");
}
else{
	header("Location: view.php");
}



?>