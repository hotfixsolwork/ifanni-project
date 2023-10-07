<?php
session_start();
require_once __DIR__ . '/../inc/initDb.php';



DB::insert('doctors', array(
    "therapy_center_id"                             =>  $_POST['therapy_center_id'],
    "name"                             =>  $_POST['name'],
));

echo "success";
