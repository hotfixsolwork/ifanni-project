<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $cityId = $_POST['id'];
    $serviceCity = $_POST['service_city'];

    // Prepare the SQL query with parameter binding
    $sql = "UPDATE service_cities SET service_city = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("si", $serviceCity, $cityId);

        // Execute the statement
        if ($stmt->execute()) {
            // City details updated successfully
            // Redirect to the desired page
            header("Location: all-service-city.php");
            exit; // Make sure to exit to prevent further execution
        } else {
            // Error executing the statement
            echo "Error updating city details: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error preparing the statement
        echo "Error preparing SQL statement: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
