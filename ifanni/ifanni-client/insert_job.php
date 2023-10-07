<?php
session_start();
include('db_connection.php'); // Include your database connection file

if (!isset($_SESSION['client_id'])) {
    header("Location: logout.php");
    exit; // Ensure no further code execution after redirection
}

$id = $_SESSION['client_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $jobTitle = $_POST['job_title'];
    $categoryId = $_POST['category_id'];
    $countryId = $_POST['country_id'];
    $cityId = $_POST['city_id'];
    $deadlineDate = $_POST['deadline_date'];
    $Location = $_POST['location'];
    $description = $_POST['description'];

    // Convert the deadline_date string to a DateTime object
    $deadlineDateTime = new DateTime($deadlineDate);
    $today = new DateTime(); // Get the current date

    // Check if the deadline date is in the future
    if ($deadlineDateTime <= $today) {
        $response = [
            'success' => false,
            'message' => 'Deadline Date must be a future date.',
        ];
        echo json_encode($response);
        exit; // Terminate the script
    }
    

    // Handle file uploads for client_job_files
    $uploadDirectory = "job_uploads/"; // Set your upload directory path
    $uploadedFiles = [];

    foreach ($_FILES["job_files"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["job_files"]["tmp_name"][$key];
            $file_name = $_FILES["job_files"]["name"][$key];
            move_uploaded_file($tmp_name, $uploadDirectory . $file_name);

            // Add the uploaded file to the list
            $uploadedFiles[] = $file_name;
        }
    }

    // Prepare and execute the SQL query to insert the job data into the jobs table
    if (!empty($id) || $id != 0) {
        $sql = "INSERT INTO client_job (client_id, category_id, country_id, city_id, job_title, deadline_date, description, location) 
                VALUES ('$id', '$categoryId', '$countryId', '$cityId', '$jobTitle', '$deadlineDate', '$description', '$Location')";

        if ($conn->query($sql) === TRUE) {
            // Job posted successfully in the jobs table
            // Now, insert a record in the job_notification table

            $jobId = $conn->insert_id; // Get the last inserted job ID

            // Prepare and execute the SQL query to insert a notification in the job_notification table
            $notificationSql = "INSERT INTO job_notifications (client_id, job_id, date_status ) 
                                VALUES ('$id', '$jobId', NOW())";

            if ($conn->query($notificationSql) === TRUE) {
                // Notification inserted successfully

                // Insert uploaded file names into client_job_files table
                foreach ($uploadedFiles as $file_name) {
                    $fileInsertSql = "INSERT INTO client_job_files (job_id, files) 
                                    VALUES ('$jobId', '$file_name')";
                    $conn->query($fileInsertSql); // Insert each file
                }

                $response = [
                    'success' => true,
                    'message' => 'Job posted successfully!',
                    'uploaded_files' => $uploadedFiles // Include uploaded file names in the response
                ];
                echo json_encode($response);
            } else {
                // Error occurred while inserting the notification
                $response = [
                    'success' => false,
                    'message' => 'An error occurred while posting the job notification.'
                ];
                echo json_encode($response);
            }

        } else {
            // Error occurred while posting the job
            $response = [
                'success' => false,
                'message' => 'An error occurred while posting the job.'
            ];
            echo json_encode($response);
        }

        // Close the database connection
        $conn->close();
    } else {
        $response = [
            'success' => false,
            'message' => 'Something went wrong'
        ];
        echo json_encode($response);
    }
}
?>
