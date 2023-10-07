<?php
// Include your database connection file
include('db_connection.php');

// Initialize variables to store updated data
$clientName = $clientPhone = $clientAddress = $clientAbout = '';

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
        // Redirect to profile.php after updating data
        header("Location: profile.php");
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error updating profile data: " . $conn->error;
    }
}

// Fetch client data from the database
$sql = "SELECT c.*, cl.client_name, cl.client_phone, cl.client_adress, cl.client_about
FROM clients cl
INNER JOIN categories c ON cl.category_id = c.id
WHERE cl.id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the client data as an associative array
    $row = $result->fetch_assoc();
    $clientName = $row['client_name'];
    $clientPhone = $row['client_phone'];
    $clientAddress = $row['client_adress'];
    $clientAbout = $row['client_about'];
    $categoryName = $row['name'];
} else {
    echo "Client not found.";
}

// Close the database connection
$conn->close();
?>