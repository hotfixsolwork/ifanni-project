<?php
// Include your database connection file
include('db_connection.php');
//if (file_exists('db/db_connection.php')) {
  //  include('db/db_connection.php');
//} else {
    // die("The db_connection.php file does not exist.");
//}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the AJAX request
    $Name = $_POST['name'];
    $description = $_POST['description'];
    $currentDate = date("Y-m-d");
    // Prepare and execute the SQL query to insert the category data
    $sql = "INSERT INTO categories (name, create_date, description ) 
            VALUES ('$Name', '$currentDate', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "category registration successful!";
    } else {
        echo "Error: " . $conn->error;
        error_log($conn->error);
    }

    // Close the database connection
    $conn->close();
}
error_log("Error message here", 0);
?>
