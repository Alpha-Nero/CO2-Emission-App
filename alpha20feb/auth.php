<?php
session_start();

$facility_id = $_SESSION['auth_user']['facility_id'];

if ($facility_id === 0) {
    if (!isset($_SESSION['auth'])) {
        header('location:login.php');
        exit; // Ensure no further code execution after redirection
    }
} elseif ($facility_id === 1) {
    if (!isset($_SESSION['auth'])) {
        header('location:login.php');
        exit; // Ensure no further code execution after redirection
    }
    $allowed_pages = array('index.php', 'editable_template.php');
    $current_page = basename($_SERVER['PHP_SELF']); // Get the current page filename

    if (!in_array($current_page, $allowed_pages)) {
        header('location:index.php'); // Redirect to index.php if trying to access other pages
        exit; // Ensure no further code execution after redirection
    }
}else{
    if (!isset($_SESSION['auth'])) {
        header('location:login.php');
        exit; // Ensure no further code execution after redirection
    }
}
?>
