<?php
session_start();
require_once __DIR__ . '/../inc/initDb.php';

DB::update('therapy', [
    "name"                             =>  $_POST['name'],
    


], "id=%d", $_POST['therapy_center_id']);

echo ("success");


