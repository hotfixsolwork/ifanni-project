<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Name = $_POST['name'];
    $description = $_POST['description'];
    $currentDate = date("Y-m-d");

    if (empty($Name) || empty($description)) {
        echo "error";
    } else {
        $sql = "INSERT INTO categories (name, create_date, description) 
                VALUES ('$Name', '$currentDate', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
            error_log($conn->error);
        }
    }

    $conn->close();
}
?>
