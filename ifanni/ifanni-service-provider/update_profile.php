<?php
session_start();

// Include your database connection file
include('db_connection.php');

// Ensure that the session is started

// Check if the service-provider_id session variable is set
if (isset($_SESSION['service-provider_id'])) {
    $id = $_SESSION['service-provider_id'];

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve updated data from the form
        $serviceproviderName = $_POST['service_provider_name'];
        $serviceproviderPhone = $_POST['service_provider_phone'];
        $serviceproviderAddress = $_POST['service_provider_address'];
        $serviceproviderAbout = $_POST['service_provider_about'];
        $company_id = $_POST['company_id']; // Retrieve the selected company_id from the form

        // Prepare an SQL update statement using prepared statements
        $sqlUpdate = "UPDATE service_provider SET
            service_provider_name = ?,
            service_provider_phone = ?,
            service_provider_address = ?,
            service_provider_about = ?,
            company_id = ?  -- Update the company_id field
            WHERE id = ?";

        // Create a prepared statement
        $stmt = $conn->prepare($sqlUpdate);

        // Bind parameters
        $stmt->bind_param("ssssii", $serviceproviderName, $serviceproviderPhone, $serviceproviderAddress, $serviceproviderAbout, $company_id, $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Update the session data with the new client information
            $_SESSION['service_provider_name'] = $serviceproviderName;

            // Redirect to the profile page after a successful update
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where the session variable is not set or the user is not logged in
    // You can redirect the user to the login page or take appropriate action here
    // For now, let's assume client_id is not set
    $id = null;
}
?>
