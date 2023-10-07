<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Update the moderator's record in the 'moderator' table
    $sql = "UPDATE categories SET name = '$name', description = '$description' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Moderator details updated successfully
        header("Location: all-categories.php"); // Redirect to the moderator list page
        exit;
    } else {
        echo "Error updating Category details: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
