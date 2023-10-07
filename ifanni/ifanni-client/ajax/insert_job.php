<?php
session_start();
include('db_connection.php');
$id = $_SESSION['client_id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $jobTitle = $_POST['job_title'];
    $categoryId = $_POST['category_id'];
    $countryId = $_POST['country_id'];
    $cityId = $_POST['city_id'];
    $deadlineDate = $_POST['deadline_date'];
    $description = $_POST['description'];
    $Location = $_POST['location'];

    // Prepare and execute the SQL query to insert the job data into the jobs table
    $sql = "INSERT INTO client_job (client_id,category_id, country_id, job_title, city_id, deadline_date, description, location) 
            VALUES ('$id','$categoryId', '$countryId', '$jobTitle', '$cityId', '$deadlineDate', '$description' '$Location')";

    if ($conn->query($sql) === TRUE) {
        // Job posted successfully in the jobs table
        // Now, insert a record in the job_notification table

        $jobId = $conn->insert_id; // Get the last inserted job ID

        // Prepare and execute the SQL query to insert a notification in the job_notification table
        $notificationSql = "INSERT INTO  job_notifications (client_id, job_id, date_status) 
                            VALUES ('$id', '$jobId', NOW())";

        if ($conn->query($notificationSql) === TRUE) {
            // Notification inserted successfully
            $response = [
                'success' => 'success',
                'message' => 'Job posted successfully!'
            ];
            echo json_encode($response);
        } else {
            // Error occurred while inserting the notification
            $response = [
                'success' => 'false',
                'message' => 'An error occurred while posting the job notification.'
            ];
            echo json_encode($response);
        }
    } else {
        // Error occurred while posting the job
        $response = [
            'success' => 'false',
            'message' => 'An error occurred while posting the job.'
        ];
        echo json_encode($response);
    }

    // Close the database connection
    $conn->close();
}
// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
