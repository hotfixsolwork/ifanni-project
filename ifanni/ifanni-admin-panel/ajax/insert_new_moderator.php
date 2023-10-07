<?php
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($Email) || empty($password)) {
        echo "error";
    } else {
        $sql = "INSERT INTO moderator (email, password ) 
                VALUES ('$Email', '$password')";

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
