<?php
// Include any necessary files or configurations here
include 'db_connection.php';

// Initialize variables to store equipment data
$equipment_id = $equipment_name = $equipment_details = '';

// Check if an equipment ID is provided via POST
if (isset($_POST['equipment_id'])) {
    $equipment_id = $_POST['equipment_id'];

    // Retrieve and sanitize form data
    $equipment_name = $_POST['equipment_name'];
    $equipment_details = $_POST['equipment_details'];

    // Update equipment data in the database
    $sql = "UPDATE service_provider_equipment SET name = '$equipment_name', details = '$equipment_details' WHERE id = $equipment_id";

    if ($conn->query($sql) === TRUE) {
        // Existing images deleted successfully
        header("Location: all-service-equipment.php");

        // Handle image upload if needed
        if ($_FILES['images']['name'][0] != "") {
            // Remove existing images associated with this equipment
            $sql_delete_existing = "DELETE FROM service_provider_equipment_images WHERE service_provider_equipment_id = $equipment_id";
            if ($conn->query($sql_delete_existing) === TRUE) {
                echo "Existing images deleted successfully.<br>";
            } else {
                echo "Error deleting existing images: " . $conn->error . "<br>";
            }

            // Loop through each uploaded image
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $image_name = $_FILES['images']['name'][$key];
                $image_tmp = $_FILES['images']['tmp_name'][$key];

                // Specify the directory where you want to save the uploaded images
                $target_dir = "equipment_uploads/";

                // Move the uploaded image to the target directory
                if (move_uploaded_file($image_tmp, $target_dir . $image_name)) {
                    // Insert image information into the service_provider_equipment_images table
                    $sql = "INSERT INTO service_provider_equipment_images (service_provider_equipment_id, images) VALUES ('$equipment_id', '$image_name')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Image uploaded and inserted into the database.<br>";
                    } else {
                        echo "Error inserting image data into the database: " . $conn->error . "<br>";
                    }
                } else {
                    echo "Error uploading image: " . $_FILES['images']['error'][$key] . "<br>";
                }
            }
        }

        // Redirect to equipment.php after updating data
        header("Location: all-service-equipment.php");
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error updating equipment data: " . $conn->error . "<br>";
    }
}
?>
