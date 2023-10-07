<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['detail'];

    // Update the moderator's record in the 'moderator' table
    $sql = "UPDATE company SET name = '$name', detail = '$description' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Moderator details updated successfully
        header("Location: all-company.php"); // Redirect to the moderator list page
        exit;
    } else {
        echo "Error updating Company details: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
