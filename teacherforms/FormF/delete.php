<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] !== true){
    header("location: ../../index.html");
    exit;
}
$id = $_SESSION['AID'];
$uid = isset($_POST['uid2']) ? $_POST['uid2'] : '';
$type = 'formF';

$sql1 = "SELECT * FROM files WHERE ID = '$id' and UID='$uid'";
    $result1 = mysqli_query ($conn,$sql1) or die ('Error');
    if(mysqli_num_rows($result1)!=0)
    {

$sql = 'DELETE formf,files FROM formf INNER JOIN files  ON formf.UID = files.UID  WHERE formf.ID=:id AND formf.UID=:uid';
$dir_handle = '';
$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id,':uid' => $uid])) {

	$dirname = '../../file/uploads/Teacher/'. $id.'/'.$type.'/'.$uid;
	if (is_dir($dirname))
           $dir_handle = opendir($dirname);
     if (!$dir_handle)
          return false;
     while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
     }
     closedir($dir_handle);
     rmdir($dirname); 
  header("Location:index.php");
}
else{
	echo "Error in Deletion!!!";
}


}else{
  echo "2";

  $sql = 'DELETE FROM formf WHERE ID=:id and UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':id' => $id,':uid' => $uid])) {
    header("Location: index.php");
  }

}