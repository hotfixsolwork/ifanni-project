<?php
// Include your database connection file
include('db_connection.php');

// Initialize a response array
$response = array();

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
        $response['status'] = 'success';
        $response['message'] = 'Service Area registration successful!';
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $conn->error;
        error_log($conn->error);
    }

    // Close the database connection
    $conn->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
