<?php
$conn = mysqli_connect('localhost', 'root', '', 'dbms_project');
session_start();
$id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
$uid=$_GET['uid'];
$type=$_GET['type'];

$dirname = '../../file/uploads/'. $id.'/'.$type.'/'.$uid;
$dir_handle = '';
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
    // header("Location:index.php");
?>