<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update the moderator's record in the 'moderator' table
    $sql = "UPDATE moderator SET email = '$email', password = '$password' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Moderator details updated successfully
        header("Location: all-moderators.php"); // Redirect to the moderator list page
        exit;
    } else {
        echo "Error updating moderator details: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
