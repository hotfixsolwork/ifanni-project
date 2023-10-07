<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the AJAX request
    $serviceproviderName = $_POST['service_provider_name'];
    $serviceproviderEmail = $_POST['service_provider_email'];
    $serviceproviderPhone = $_POST['service_provider_phone'];
    $serviceproviderAddress = $_POST['service_provider_address'];

    // Prepare and execute the SQL query to insert the serviceprovider data
    $sql = "INSERT INTO service_provider (service_provider_name, service_provider_email, service_provider_phone, service_provider_address) 
            VALUES ('$serviceproviderName', '$serviceproviderEmail', '$serviceproviderPhone', '$serviceproviderAddress')";

    if ($conn->query($sql) === TRUE) {
        echo "serviceprovider registration successful!";
    } else {
        echo "Error: " . $conn->error;
        error_log($conn->error);
    }

    // Close the database connection
    $conn->close();
}
error_log("Error message here", 0);
?>
