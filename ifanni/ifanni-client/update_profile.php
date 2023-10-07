<?php
session_start();

// Include your database connection file
include('assets/db/db_connection.php');

// Ensure that the session is started

// Check if the client_id session variable is set
if (isset($_SESSION['client_id'])) {
    $id = $_SESSION['client_id'];

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve updated data from the form
        $clientName = $_POST['client_name'];
        $clientPhone = $_POST['client_phone'];
        $clientAddress = $_POST['client_adress'];
        $clientAbout = $_POST['client_about'];

        // Perform database update
        $sqlUpdate = "UPDATE clients SET
        client_name = '$clientName',
        client_phone = '$clientPhone',
        client_adress = '$clientAddress',
        client_about = '$clientAbout'
        WHERE id = $id";

        if ($conn->query($sqlUpdate) === TRUE) {
            // Update the session data with the new client information
            $_SESSION['client_name'] = $clientName;

            // Redirect to the profile page after successful update
            header("Location: profile.php");
            exit();
        } else {
            echo "Error updating profile: " . $conn->error;
        }
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
