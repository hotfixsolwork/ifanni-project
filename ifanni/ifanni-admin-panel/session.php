<?php
include('assets/inc/initDb.php');
global $db;
session_start();

$user_check = $_SESSION['login_user'];

$row = DB::queryFirstRow("select * from admin where email = '$user_check' ");


//$ses_sql = mysqli_query($db, "select email from admin where username = '$user_check' ");

//$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['email'];

if (!isset($_SESSION['login_user'])) {
    header("location:login.php");
    die();
}

