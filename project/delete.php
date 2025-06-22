
<?php
require 'db.php';
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
    header("location: ../index.html");
    exit;
}
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$uid = isset($_POST['uid2']) ? $_POST['uid2'] : '';
$type = 'Project';

  $nRows = $connection->query("SELECT COUNT(UID) from files WHERE UID='$uid'")->fetchColumn();
  
if($nRows > 0){

$sql = 'DELETE project_competition,files FROM project_competition INNER JOIN files  ON project_competition.UID = files.UID  WHERE project_competition.ID=:id AND project_competition.UID=:uid';

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

  $sql = 'DELETE FROM project_competition WHERE UID=:uid';

$statement = $connection->prepare($sql);
if ($statement->execute([':uid' => $uid])) {
    header("Location:index.php");

}else{
    echo "Error in Deletion!!!";
}


}