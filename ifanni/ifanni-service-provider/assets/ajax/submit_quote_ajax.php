<?php
session_start();
include 'db_connection.php';

// Initialize response array
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = $_POST['job_id'];
    $details = $_POST['details'];
    $quote = $_POST['quote'];
    $service_provider_id = $_SESSION['service-provider_id']; // Assuming you've started a session

    // Check if any field is empty
    if (empty($job_id) || empty($details) || empty($quote)) {
        $response['success'] = false;
        $response['message'] = "All fields are required!";
    } else {
        $query = "INSERT INTO moderator_job_response_notification (job_id, service_provider_id, details, price_quote_by_service_provider) VALUES ('$job_id', '$service_provider_id', '$details', '$quote')";

        if ($conn->query($query)) {
            $response['success'] = true;
            $response['message'] = "Quote and details submitted successfully!";
        } else {
            $response['success'] = false;
            $response['message'] = "Error: " . $conn->error;
        }
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request method.";
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
