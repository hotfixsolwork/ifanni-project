<?php
include('db_connection.php');
session_start();

$serviceProviderId = $_SESSION['service-provider_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceTitle = $_POST['service_title'];
    $categoryId = $_POST['category_id'];
    $countryId = $_POST['country_id'];
    $cityId = $_POST['city_id'];
    $description = $_POST['description'];

    if (empty($serviceTitle) || empty($categoryId) || empty($countryId) || empty($cityId) || empty($description)) {
        echo "error";
    } else {
        $sql = "INSERT INTO service_provider_service (service_provider_id, service_title, category_id, country_id, city_id, description) 
                VALUES ('$serviceProviderId', '$serviceTitle', $categoryId, $countryId, $cityId, '$description')";

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
