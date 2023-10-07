<?php
// Include your database connection file
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve values from the AJAX request
    $Name = $_POST['name'];
    $currentDate = date("Y-m-d");
    // Prepare and execute the SQL query to insert the category data
    $sql = "INSERT INTO countries (name, create_date) 
            VALUES ('$Name', '$currentDate')";

    if ($conn->query($sql) === TRUE) {
        echo "country registration successful!";
        // Redirect to all-country.php after successful insertion
        //header("Location: ../all-country.php");
      //exit();
    } else {
        echo "Error: " . $conn->error;
        error_log($conn->error);
    }

    // Close the database connection
    $conn->close();
}
error_log("Error message here", 0);
?>
