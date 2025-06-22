<?php
// connect to the database
session_start();
if(isset($_SESSION["login"]) || $_SESSION["login"] == true || isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

$conn = mysqli_connect('localhost', 'root', '', 'dbms_project');
$id = '';
$uid=$_GET['uid'];
$type=$_SESSION['type'];
$flag = $_SESSION['flag_file'];
$sql = "SELECT * FROM files";
$file_pointer = '';
$destination = '';


$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    // destination of the file on the server
    if($flag == 1){
        $id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
        $file_pointer = 'uploads/Student/'.$id.'/'.$type.'/'.$uid;
        $destination = $file_pointer.'/' . $filename;
    }
    else if($flag == 2){
        $id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
        $file_pointer = 'uploads/Teacher/'.$id.'/'.$type.'/'.$uid;
        $destination = $file_pointer.'/' . $filename;
    }
    


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
            $sql = "INSERT INTO files (UID,ID,Type,Name,size) VALUES ('$uid','$id','$type','$filename', $size)";
            if (mysqli_query($conn, $sql)) {
                //echo "File uploaded successfully";
                if($type=='Sports'){
                    header("location: ../sports/index.php");
                }
                elseif($type=='Arts'){
                    header("location: ../arts/index.php");
                }
                elseif($type=='Social'){
                    header("location: ../social/index.php");
                }
                elseif($type=='Comp'){
                    header("location: ../comp/index.php");
                }
                elseif($type=='Internship'){
                    header("location: ../internship/index.php");
                } 
                elseif($type=='Paper'){
                    header("location: ../paper/index.php");
                }  
                elseif($type=='Project'){
                    header("location: ../project/index.php");
                }  
                elseif($type=='FormA'){
                    header("location: ../teacherforms/formA/index.php");
                }
                elseif($type=='FormB'){
                    header("location: ../teacherforms/formB/index.php");
                }
                elseif($type=='FormC'){
                    header("location: ../teacherforms/formC/index.php");
                }
                elseif($type=='FormD'){
                    header("location: ../teacherforms/formD/index.php");
                }
                elseif($type=='FormE'){
                    header("location: ../teacherforms/formE/index.php");
                } 
                elseif($type=='FormF'){
                    header("location: ../teacherforms/formF/index.php");
                }         
                elseif($type=='FormG'){
                    header("location: ../teacherforms/formG/index.php");
                }
                elseif($type=='FormH'){
                    header("location: ../teacherforms/formH/index.php");
                }
                elseif($type=='FormI'){
                    header("location: ../teacherforms/formI/index.php");
                }
                elseif($type=='FormJ'){
                    header("location: ../teacherforms/formJ/index.php");
                }
                elseif($type=='FormK'){
                    header("location: ../teacherforms/formK/index.php");
                }
                elseif($type=='FormL'){
                    header("location: ../teacherforms/formL/index.php");
                }
                elseif($type=='FormM'){
                    header("location: ../teacherforms/formM/index.php");
                }
                elseif($type=='FormN'){
                    header("location: ../teacherforms/formN/index.php");
                }
                elseif($type=='FormO'){
                    header("location: ../teacherforms/formO/index.php");
                }
                elseif($type=='FormP'){
                    header("location: ../teacherforms/formP/index.php");
                }
                elseif($type=='FormQ'){
                    header("location: ../teacherforms/formQ/index.php");
                }
                elseif($type=='FormR'){
                    header("location: ../teacherforms/formR/index.php");
                }
                elseif($type=='FormS'){
                    header("location: ../teacherforms/formS/index.php");
                }
                elseif($type=='FormT'){
                    header("location: ../teacherforms/formT/index.php");
                }

            }
        } else {
            echo "Failed to upload file.";
        }
    }
}


// Uploads files
elseif (isset($_POST['save1'])) { // if save button on the Form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];

    if($flag == 1){
        $id = isset($_SESSION['ID']) ? $_SESSION['ID'] : '';
        $file_pointer = 'uploads/Student/'.$id.'/'.$type.'/'.$uid;
        $destination = $file_pointer.'/' . $filename;
    }
    else if($flag == 2){
        $id = isset($_SESSION['AID']) ? $_SESSION['AID'] : '';
        $file_pointer = 'uploads/Teacher/'.$id.'/'.$type.'/'.$uid;
        $destination = $file_pointer.'/' . $filename;
    }

    if (!file_exists($file_pointer)) {
    mkdir($file_pointer, 0777, true);
    }

    $files1 = glob($file_pointer.'/*');  
    // Deleting all the files in the list 
    foreach($files1 as $file1) { 
        if(is_file($file1))   
            // Delete the given file 
            unlink($file1);  
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
            $sql = "UPDATE files SET Name='$filename',size=$size WHERE UID='$uid'";
            if (mysqli_query($conn, $sql)) {
                //echo "File uploaded successfully";
                if($type=='Sports'){
                    header("location: ../sports/index.php");
                }
                elseif($type=='Arts'){
                    header("location: ../arts/index.php");
                }
                elseif($type=='Social'){
                    header("location: ../social/index.php");
                }
                elseif($type=='Comp'){
                    header("location: ../comp/index.php");
                }
                elseif($type=='Internship'){
                    header("location: ../internship/index.php");
                } 
                elseif($type=='Paper'){
                    header("location: ../paper/index.php");
                }
                elseif($type=='Project'){
                    header("location: ../project/index.php");
                }
                elseif($type=='FormA'){
                    header("location: ../teacherforms/formA/index.php");
                }
                elseif($type=='FormB'){
                    header("location: ../teacherforms/formB/index.php");
                } 
                elseif($type=='FormC'){
                    header("location: ../teacherforms/formC/index.php");
                }
                elseif($type=='FormD'){
                    header("location: ../teacherforms/formD/index.php");
                }
                elseif($type=='FormE'){
                    header("location: ../teacherforms/formE/index.php");
                }
                elseif($type=='FormF'){
                    header("location: ../teacherforms/formF/index.php");
                }
                elseif($type=='FormG'){
                    header("location: ../teacherforms/formG/index.php");
                }
                elseif($type=='FormH'){
                    header("location: ../teacherforms/formH/index.php");
                }
                elseif($type=='FormI'){
                    header("location: ../teacherforms/formI/index.php");
                }
                elseif($type=='FormJ'){
                    header("location: ../teacherforms/formJ/index.php");
                }
                elseif($type=='FormK'){
                    header("location: ../teacherforms/formK/index.php");
                }
                elseif($type=='FormL'){
                    header("location: ../teacherforms/formL/index.php");
                }
                elseif($type=='FormM'){
                    header("location: ../teacherforms/formM/index.php");
                }
                elseif($type=='FormN'){
                    header("location: ../teacherforms/formN/index.php");
                }
                elseif($type=='FormO'){
                    header("location: ../teacherforms/formO/index.php");
                }
                elseif($type=='FormP'){
                    header("location: ../teacherforms/formP/index.php");
                }
                elseif($type=='FormQ'){
                    header("location: ../teacherforms/formQ/index.php");
                }
                elseif($type=='FormR'){
                    header("location: ../teacherforms/formR/index.php");
                }
                elseif($type=='FormS'){
                    header("location: ../teacherforms/formS/index.php");
                }
                elseif($type=='FormT'){
                    header("location: ../teacherforms/formT/index.php");
                }


            }
        } else {
            echo "Failed to upload file.";
        }
    }
}

}else{
    if($_SESSION['login_flag'] == 1){
        header("location: ../Student_login.php");
        exit;
    }
    
    else if($_SESSION['login_flag'] == 2){
        header("location: ../Authority_login.php");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../Admin_login.php");
        exit;
    }
    
    
}



?>