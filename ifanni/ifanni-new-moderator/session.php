<?php
include('assets/inc/initDb.php');
global $db;
session_start();

$user_check = $_SESSION['login_user'];

// Select the moderator based on their email
$row = DB::queryFirstRow("SELECT * FROM moderator WHERE email = %s", $user_check);

// Check if a moderator with the provided email exists
if (!$row) {
    header("location: login.php");
    die();
}

// Store moderator ID and email in session
$_SESSION['moderator_id'] = $row['id'];
$_SESSION['moderator_email'] = $row['email'];

if (!isset($_SESSION['login_user']) || !isset($_SESSION['moderator_id'])) {
    header("location: login.php");
    die();
}
?>
