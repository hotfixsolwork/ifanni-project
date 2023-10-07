<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the AJAX request
    $Country_id = $_POST['country_id'];
    $City_id = $_POST['service_city_id'];
    $Name = $_POST['service_area'];

    $currentDate = date("Y-m-d");
    // Prepare and execute the SQL query to insert the category data
    $sql = "INSERT INTO service_areas (country_id, service_city_id,  service_area, create_date) 
            VALUES ($Country_id, $City_id, '$Name', '$currentDate')";

    if ($conn->query($sql) === TRUE) {
        echo "city registration successful!";
        // Redirect to all-country.php after successful insertion
        //header("Location: ../all-country.php");
      //exit();
    } else {
        echo "Error: " . $conn->error;
        error_log($conn->error);
    }

    // Close the database connection
    $conn->close();
}
error_log("Error message here", 0);
?>
