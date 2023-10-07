<?php
require 'assets/inc/initDb.php';

$id = $_GET['remove-moderator'];
DB::delete('moderator', 'id=%d', $id);

// Redirect using PHP's header function
header('Location: all-moderators.php');
exit; // Make sure to exit to prevent further script execution


