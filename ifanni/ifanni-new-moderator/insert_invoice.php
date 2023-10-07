<?php
include('db_connection.php');
session_start();
$id = $_POST['customAttribute1'];

// Fetch data from the database based on the provided ID
$selectQuery = "SELECT job_id, service_provider_id FROM moderator_job_response_notification WHERE id = $id";
$result = $conn->query($selectQuery);

if (!$result) {
    die("Query execution failed: " . $conn->error);
}

$moderator_id = $_SESSION['moderator-id'];

if ($row1 = $result->fetch_assoc()) {
    $jobId = $row1['job_id'];

    // Fetch the client ID associated with the job
    $selectQueryNew = "SELECT client_id FROM client_job WHERE id = " . $jobId;
    $resultNew = $conn->query($selectQueryNew);

    if (!$resultNew) {
        die("Query execution failed: " . $conn->error);
    }

    if ($rowNew = $resultNew->fetch_assoc()) {
        $clientId = $rowNew['client_id'];
    }
    
    $serviceProviderId = $row1['service_provider_id'];

    // Update the status to indicate that the invoice has been sent
    $query = "UPDATE moderator_job_response_notification SET invoice_sent = '1' WHERE id = " . $id;
    
    if ($conn->query($query) === TRUE) {
        // Invoice data from the form
        $payment = $_POST['payment'];
        $due_date = $_POST['due_date'];

        // Insert invoice data into the 'invoice' table
        $insertQuery = "INSERT INTO invoice (job_id, moderator_id, client_id, service_provider_id, payment, due_date, today_date) VALUES ('$jobId', '$moderator_id', '$clientId', '$serviceProviderId', '$payment', NOW(), NOW())";
        
        if ($conn->query($insertQuery)) {
            // Success message
            echo "Success";
        } else {
            echo $conn->error;
        }
    } else {
        echo $conn->error;
    }
} else {
    echo "Record not found";
}
?>
