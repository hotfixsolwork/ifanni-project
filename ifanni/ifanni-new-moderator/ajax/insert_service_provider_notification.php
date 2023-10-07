<?php
// Include database configuration file
include('db_connection.php');
session_start();

// Initialize response array
$response = array();

// Get the service_provider_id from the URL query parameters
$service_provider_id = $_POST['service_provider_id'];

// Check if the service_provider_id is valid (you can add more validation)
if ($service_provider_id <= 0) {
    $response['success'] = false;
    $response['message'] = "Invalid service_provider_id";
    echo json_encode($response);
    exit;
}

// Get other form data
$job_id = $_POST['notification_id']; // Consider renaming this field for clarity
$text = $_POST['description'];

// Ensure text is not empty
if (trim($text) !== "") {
    // Insert the data into the database, and also retrieve service provider details
    $query = "INSERT INTO service_provider_new_job_request (service_provider_id, job_id, text) VALUES ('$service_provider_id', '$job_id', '$text')";
    
    if ($conn->query($query)) {
        // Data inserted successfully, now retrieve service provider details
        $service_provider_query = "SELECT * FROM service_provider WHERE id = '$service_provider_id'";
        $service_provider_result = $conn->query($service_provider_query);

        if ($service_provider_result->num_rows > 0) {
            $service_provider_row = $service_provider_result->fetch_assoc();
            $response['success'] = true;
            $response['message'] = "Data inserted successfully for service provider: " . $service_provider_row["service_provider_name"];
        } else {
            $response['success'] = true;
            $response['message'] = "Data inserted successfully, but service provider details not found.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Error: " . $conn->error;
    }
} else {
    $response['success'] = false;
    $response['message'] = "Description is required!";
}

// Close the database connection
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
