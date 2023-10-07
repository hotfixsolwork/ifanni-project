<?php
// include database configuration file
include('db_connection.php');

// Get all form data
$service_provider_id = 1; // As mentioned, hardcoded for now
$job_id = $_POST['notification_id']; // The form field name is misleading, consider renaming it to job_id for clarity
$text = $_POST['description'];

// Ensure text is not empty
if(trim($text) !== "") {
    // Insert the data into the database
    $query = "INSERT INTO service_provider_notification (service_provider_id, job_id, text) VALUES ('$service_provider_id', '$job_id', '$text')";

    if($conn->query($query)) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Description is required!";
}
?>