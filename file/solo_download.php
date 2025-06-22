<?php 
    session_start();

    if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login"]) || $_SESSION["login"] == true ||  isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){ 

    $uid=$_GET['uid'];
    $type = $_SESSION['type'];
    $flag = $_SESSION['flag_file']; 
      
    if($flag == 1){
        $id = isset($_GET['ID']) ? $_GET['ID'] : $_SESSION['ID'];

    }
    else if($flag == 2){
        $id = isset($_GET['ID']) ? $_GET['ID'] : $_SESSION['AID'];
    }
    
    
    $conn = mysqli_connect('localhost', 'root', '', 'dbms_project');
    $sql = "SELECT * FROM files WHERE UID= '$uid'";
    $result = mysqli_query($conn, $sql);
    $file = mysqli_fetch_assoc($result);
    if($flag == 1){
        $file_pointer = 'uploads/Student/'.$id.'/'.$type.'/'.$uid;
    }
    else if($flag == 2){
        $file_pointer = 'uploads/Teacher/'.$id.'/'.$type.'/'.$uid;
    }
    $filepath = $file_pointer.'/' . $file['Name'];

    //echo $filepath;

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_pointer.'/' . $file['Name']));
        readfile($file_pointer.'/' . $file['Name']);
        exit;
    }
    else{
        echo "No Files Found!!!";
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
