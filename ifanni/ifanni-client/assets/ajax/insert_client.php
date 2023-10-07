<?php
// Include your database connection file
include('assets/db/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the AJAX request
    $clientName = $_POST['client_name'];
    $clientEmail = $_POST['client_email'];
    $clientPhone = $_POST['client_phone'];
    $clientAddress = $_POST['client_adress'];

    // Prepare and execute the SQL query to insert the client data
    $sql = "INSERT INTO clients (client_name, client_email, client_phone, client_adress) 
            VALUES ('$clientName', '$clientEmail', '$clientPhone', '$clientAddress')";

    if ($conn->query($sql) === TRUE) {
        echo "Client registration successful!";
    } else {
        echo "Error: " . $conn->error;
        error_log($conn->error);
    }

    // Close the database connection
    $conn->close();
}
error_log("Error message here", 0);
?>
