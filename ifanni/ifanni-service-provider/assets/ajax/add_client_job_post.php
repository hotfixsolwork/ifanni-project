<?php
session_start();
require_once __DIR__ . '/../inc/initDb.php';



DB::insert('client_job', array(
    // "client_id"                               =>  $_POST['client_id'],
    "category_id"                             =>  $_POST['category_id'],
    "country_id"                               =>  $_POST['country_id'],
    "job_title"                                 =>  $_POST['job_title'],
    "budget"                                  =>  $_POST['budget'],
    "deadline_date"                            =>  $_POST['deadline_date'],
    "description"                              =>  $_POST['description'],
));

echo "success";
