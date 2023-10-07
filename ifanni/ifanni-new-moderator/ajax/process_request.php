<?php
include('db_connection.php');

$id = $_POST['id'];
$status = $_POST['action'];
$message = $_POST['message'];


$query = "UPDATE moderator_job_response_notification SET job_status = '$status', message_from_moderator = '$message' WHERE id = $id";
$conn->query($query);




$selectQuery = "SELECT job_id, service_provider_id, message_from_moderator, job_status FROM moderator_job_response_notification WHERE id = $id";
$result = $conn->query($selectQuery);

if ($row = $result->fetch_assoc()) {
    $jobId = $row['job_id'];
    $serviceProviderId = $row['service_provider_id'];
    $text = $row['message_from_moderator'];



    $query2 = "UPDATE  job_notifications SET job_status = '$status' WHERE job_id = $jobId";
    $conn->query($query2);

    // Inserting data into service_provider_notification
    $insertQuery = "INSERT INTO service_provider_notification (service_provider_id, job_id, text, read_notification) VALUES ($serviceProviderId, $jobId, '$text', '0')";
    $conn->query($insertQuery);
}
echo "success";


// jab service provider response kare ga quote apni, to hame moderator k notification pe bubble lagana hai