<?php
session_start();
if(isset($_SESSION["login_auth"]) || $_SESSION["login_auth"] == true || isset($_SESSION["login_admin"]) || $_SESSION["login_admin"] == true){

if(isset($_POST['column']) && isset($_POST['order'])){
    $_SESSION['column'] = $_POST['column']; 
    $_SESSION['order'] = $_POST['order']; 
    $_SESSION['flag'] = $_POST['flag'];
    header("Location: sort.php"); 
}
else if(isset($_POST['uid1'])){
    $_SESSION['uid'] = $_POST['uid1'];
    $_SESSION['A'] = $_POST['aid']; 
    header("Location: edit.php");
}
else{
	header("Location: index.php");
}


}else{
	if($_SESSION['login_flag'] == 2){
        header("location: ../../../index.html");
        exit;
    }

    else if($_SESSION['login_flag'] == 3){
        header("location: ../../../Admin_login.html");
        exit;
    }
    
    
}

?>