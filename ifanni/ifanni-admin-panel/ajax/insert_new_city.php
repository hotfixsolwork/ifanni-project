<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the AJAX request
    $Country_id = $_POST['country_id'];
    $Name = $_POST['service_city'];
    $currentDate = date("Y-m-d");

    if (empty($Name)) {
        echo "error";
    } else {
        // Prepare and execute the SQL query to insert the city data
        $sql = "INSERT INTO service_cities (country_id, service_city, create_date) 
                VALUES ($Country_id, '$Name', '$currentDate')";

        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
            error_log($conn->error);
        }
    }

    // Close the database connection
    $conn->close();
}
?>
