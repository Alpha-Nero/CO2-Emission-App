<?php
session_start();
include 'database.php';

if(isset($_POST['logout'])){
    session_destroy();
    unset($_SESSION['auth']);

    unset($_SESSION['auth_user']);

    $_SESSION['status']="Logged Out Success";
    header('location: login.php');
}

?>