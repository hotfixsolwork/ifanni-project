<?php
// Include any necessary files or configurations here
include 'db_connection.php';

// Initialize variables to store job data
$job_id = $job_title = $category_id = $budget = $country_id = $deadline_date = $description = '';

// Check if a job ID is provided via POST
if (isset($_POST['job_id'])) {
    $job_id = $_POST['job_id'];

    // Retrieve and sanitize form data
    $job_title = $_POST['job_title'];
    $category_id = $_POST['category_id'];
    $budget = $_POST['budget'];
    $country_id = $_POST['country_id'];
    $deadline_date = $_POST['deadline_date'];
    $description = $_POST['description'];

    // Update job data in the database
    $sql = "UPDATE client_job SET job_title = '$job_title', category_id = '$category_id', budget = '$budget', country_id = '$country_id', deadline_date = '$deadline_date', description = '$description' WHERE id = $job_id";

    if ($conn->query($sql) === TRUE) {
        // Existing images deleted successfully
        header("Location: jobs.php");

        // Handle image upload if needed
        if ($_FILES['images']['name'][0] != "") {
            // Remove existing images associated with this job
            $sql_delete_existing = "DELETE FROM client_job_files WHERE job_id = $job_id";
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
                $target_dir = "job_uploads/";

                // Move the uploaded image to the target directory
                if (move_uploaded_file($image_tmp, $target_dir . $image_name)) {
                    // Insert image information into the client_job_files table
                    $sql = "INSERT INTO client_job_files (job_id, files) VALUES ('$job_id', '$image_name')";
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

        // Redirect to jobs.php after updating data
        header("Location: jobs.php");
        exit(); // Ensure that no further code is executed after the redirect
    } else {
        echo "Error updating job data: " . $conn->error . "<br>";
    }
}
?>
