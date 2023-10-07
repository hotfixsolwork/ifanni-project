<?php
include('assets/inc/initDb.php');
global $db;
session_start();

$user_check = $_SESSION['login_user'];

$row = DB::queryFirstRow("select * from clients where client_email = '$user_check' ");


//$ses_sql = mysqli_query($db, "select email from admin where username = '$user_check' ");

//$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['client_email'];
$login_session_id = $row['id'];
$_SESSION['client_id'] = $login_session_id;

if (!isset($_SESSION['client_id'])) {
    header("location:login.php");
    die();
}

