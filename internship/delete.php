
<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location:  ../index.html");
    exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$uid = isset($_POST['uid2']) ? $_POST['uid2'] : '';
$type = 'Internship';

  $nRows = $connection->query("SELECT COUNT(UID) from files WHERE UID='$uid'")->fetchColumn();
  
if($nRows > 0){

$sql = 'DELETE internship,files FROM internship INNER JOIN files  ON internship.UID = files.UID  WHERE internship.ID=:id AND internship.UID=:uid';

$statement = $connection->prepare($sql);
if ($statement->execute([':id' => $id,':uid' => $uid])) {

	$dirname = '../../file/uploads/Student/'. $id.'/'.$type.'/'.$uid;
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

  $sql = 'DELETE FROM internship WHERE UID=:uid';

$statement = $connection->prepare($sql);
if ($statement->execute([':uid' => $uid])) {
    header("Location:index.php");

}else{
    echo "Error in Deletion!!!";
}


}