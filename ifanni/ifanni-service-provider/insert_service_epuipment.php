<?php
// Start the session (if not already started)
session_start();

// Get service provider ID from the session (assuming it's already set)
$service_provider_id = $_SESSION['service-provider_id'];

include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if any field is empty
    $name = $_POST['name'];
    $status = $_POST['availability_status'];
    $description = $_POST['description'];

    if (empty($name) || empty($status) || empty($description) || empty($_FILES['job_files']['name'][0])) {
        // Display a JSON response indicating that a field is empty
        echo json_encode(["success" => false, "message" => "Please fill in all fields and select at least one file."]);
        exit;
    }

    // Insert equipment details into the service_provider_equipment table
    $sql = "INSERT INTO service_provider_equipment (service_provider_id, name, details, availability_status) 
            VALUES ('$service_provider_id', '$name', '$description', '$status')";

    if ($conn->query($sql) === TRUE) {
        // Equipment details inserted successfully
        $equipment_id = $conn->insert_id; // Get the ID of the newly inserted equipment

        // Handle image uploads
        $uploadedImages = [];
        $errors = [];

        foreach ($_FILES['job_files']['tmp_name'] as $key => $tmp_name) {
            $originalFileName = $_FILES['job_files']['name'][$key];

            // Move the uploaded file to the destination folder with the original filename
            $uploadDir = 'equipment_uploads/';
            $targetFilePath = $uploadDir . $originalFileName;

            if (move_uploaded_file($tmp_name, $targetFilePath)) {
                $uploadedImages[] = $originalFileName; // Store the original filename
            } else {
                $errors[] = "Failed to upload $originalFileName";
            }
        }

        // Check if there are any errors
        if (!empty($errors)) {
            header('Content-Type: application/json');
            echo json_encode(["success" => false, "message" => "Error: " . implode(", ", $errors)]);
        } else {
            // All images were successfully uploaded
            // Combine original image filenames into a comma-separated string
            $imagesString = implode(', ', $uploadedImages);

            // Insert the comma-separated image string into the service_provider_equipment_images table
            $image_sql = "INSERT INTO service_provider_equipment_images (service_provider_id, service_provider_equipment_id, images)
                          VALUES ('$service_provider_id', '$equipment_id', '$imagesString')";

            if ($conn->query($image_sql) === TRUE) {
                echo json_encode(["success" => true, "message" => "Equipment submitted successfully!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Error: " . $image_sql . "<br>" . $conn->error]);
            }
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    // Invalid request method
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
