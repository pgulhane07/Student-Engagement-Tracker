<?php
  session_start();
  $id='';
  
    $id = isset($_POST['id']) ? $_POST['id'] : $_SESSION['ID'];
  
  $msg = "";
  $msg_class = "";
  $flag = 0;
  $sql="";
  $uid = 'PROF-'.$id;
  $conn =mysqli_connect("localhost", "root", "root", "dbms_project", 8889);
  if (isset($_POST['submit'])) {
    $profileImageName = $_FILES['profileImage']['name'];
    if($_SESSION['login_flag']==1){
    $target_dir = '../file/uploads/Student/'.$id.'/Profile';
    }
    
    if (!file_exists($target_dir)) {
      $flag=1;
    mkdir($target_dir, 0777, true);
    }
    if($flag==0){
        $files1 = glob($target_dir.'/*');  
        // Deleting all the files in the list 
        foreach($files1 as $file1) { 
            if(is_file($file1))   
                // Delete the given file 
            unlink($file1);
        }
    }
    $target_file = $target_dir .'/'. $profileImageName;
    // VALIDATION
    // validate image size. Size is calculated in Bytes
     $size = $_FILES['profileImage']['size'];
    if($_FILES['profileImage']['size'] > 2000000) {
      $msg = "Image size should not be greated than 2 MB";
      $msg_class = "alert-danger";
    }
    
    // Upload image only if no errors
    if (empty($error)) {
       $uid = 'PROF-'.$id;
       
      if(move_uploaded_file($_FILES['profileImage']['tmp_name'], $target_file)) {    
       if($flag==1){
           $sql = "INSERT INTO files (UID,ID,Type,Name,size) VALUES ('$uid','$id','Profile','$profileImageName', $size)";
        }
        else{
       
           $sql = "UPDATE files SET Name='$profileImageName',size=$size WHERE UID='$uid'";
        }
        if(mysqli_query($conn, $sql)){
          $msg = "Image uploaded and saved in the Database";
          $msg_class = "alert-success";
        } else {
          $msg = "There was an error in the database";
          $msg_class = "alert-danger1";
        }
      } else {
        $error = "There was an error uploading the file";
        $msg = "alert-danger2";
      }
    }
  }

?>
