<?php



session_start();
include('db_connection.php');
if (!isset($_SESSION['client_id'])) {
    header("Location: logout.php");
}
$targetDir = "job_uploads/";
// Assuming you have the job_id being passed along with the file (e.g., in the form data)
$job_id = $_POST['job_id'];

if (!empty($_FILES)) {
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    // Move the file to the target directory
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Insert into the database
        $query = "INSERT INTO client_job_files (job_id, files) VALUES (?, ?)";

        if($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("is", $job_id, $fileName);

            if($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "File uploaded successfully!"]);
            } else {
                echo json_encode(["status" => "error", "message" => "File uploaded, but database insertion failed!"]);
            }

            $stmt->close();
        } else {
            echo json_encode(["status" => "error", "message" => "Database query preparation failed!"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "File upload failed!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "No file received!"]);
}

$mysqli->close();
?>
