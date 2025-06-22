<?php
// connect to the database
require 'db.php';
session_start();
$id=$_GET['ID'];

$uid=$_GET['uid'];
// $sql = "SELECT * FROM files";
// $result = mysqli_query($conn, $sql);

// $files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    $file_pointer = 'uploads/' . $id.'/formA/'.$filename;
     $destination = $file_pointer.'/' . $filename;


    if (!file_exists($file_pointer)) {
    mkdir($file_pointer, 0777, true);
    }
  

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx','jpg','png'])) {
        echo "You file extension must be .zip, .pdf ,.docx ,.jpg or .png";
    } elseif ($_FILES['myfile']['size'] > 3000000) { // file shouldn't be larger than 3Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            // $sql = "INSERT INTO files (UID,ID,Type,Name,size) VALUES ('$uid','$id','$type','$filename', $size)";
            // if (mysqli_query($conn, $sql)) {
            //     //echo "File uploaded successfully";
            //     if($type=='Sports'){
            //         header("location: ../sports_edit1/crud/index.php?ID=".$id);
            //     }
            //     elseif($type=='Arts'){
            //         header("location: ../arts_edit1/crud/index.php?ID=".$id);
            //     }
            //     elseif($type=='Social'){
            //         header("location: ../social_edit1/crud/index.php?ID=".$id);
            //     }
            //     elseif($type=='Comp'){
            //         header("location: ../comp_edit1/crud/index.php?ID=".$id);
            //     }              
            // }
            //alert("Data enterd sucessfully");
            $sql = 'UPDATE forma SET Filename=:filename WHERE UID=:uid';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':filename' => $filename,':uid' => $uid])) {
    $message = "Data entry made";
echo "<script type='text/javascript'>alert('$message');</script>";
    header("Location: index.php");

  }
             
            
        } else {
            echo "Failed to upload file.";
        }
    }
}