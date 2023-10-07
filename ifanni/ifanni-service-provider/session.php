<?php
session_start();
include('assets/inc/initDb.php');
global $db;


$user_check = $_SESSION['login_user'];

$row = DB::queryFirstRow("select * from service_provider where service_provider_email = '$user_check' ");


//$ses_sql = mysqli_query($db, "select email from admin where username = '$user_check' ");
$email = $row['service_provider_email'];
$login_session_username = $row['service_provider_name'];
//$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
$login_session_id = $row['id'];

$_SESSION['service_provider_name'] = $login_session_username;
$_SESSION['service_provider_email'] = $email;
//$login_session = $row['service_provider_email'];

$_SESSION['service-provider_id'] = $login_session_id;

if (!isset($_SESSION['login_user']) || !isset($_SESSION['service-provider_id'])) {
    header("location:login.php");
    die();
}

