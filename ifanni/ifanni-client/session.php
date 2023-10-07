<?php
include('assets/inc/initDb.php');
global $db;
session_start();

$user_check = $_SESSION['login_user'];

$row = DB::queryFirstRow("select * from clients where client_email = '$user_check' ");

$login_session_email = $row['client_email'];
$login_session_username = $row['client_name'];
$login_session_id = $row['id'];

// Set the session variables
$_SESSION['client_name'] = $login_session_username; // Use the correct variable here
$_SESSION['client_email'] = $login_session_email;

if (!isset($_SESSION['client_id'])) {
    header("location:login.php");
    die();
}
?>
