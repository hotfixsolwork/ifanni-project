<?php
// Include your database connection file
  include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $job_title = $_POST['job_title'];
    $category_id = $_POST['category_id'];
    $budget = $_POST['budget'];
    $country_id = $_POST['country_id'];
    $deadline_date = $_POST['deadline_date'];
    $description = $_POST['description'];

    // Prepare and execute the SQL query to update the job data
    $sql = "UPDATE client_job SET job_title = ?, category_id = ?, budget = ?, country_id = ?, deadline_date = ?, description = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ssssssi", $job_title, $category_id, $budget, $country_id, $deadline_date, $description, $job_id);

        // Set the parameter values
        $job_title = $_POST['job_title'];
        $category_id = $_POST['category_id'];
        $budget = $_POST['budget'];
        $country_id = $_POST['country_id'];
        $deadline_date = $_POST['deadline_date'];
        $description = $_POST['description'];

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: jobs.php");
        } else {
            echo "Error updating job: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
