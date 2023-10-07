<?php
require 'assets/inc/initDb.php';

// Check if the 'remove_id' parameter is set in the URL
if (isset($_GET['remove_id'])) {
    // Sanitize and retrieve the 'remove_id'
    $remove_id = intval($_GET['remove_id']);

    // Perform the database deletion operation
    $result = DB::delete('client_job', 'id=%d', $remove_id);

    if ($result) {
        // Data successfully deleted, display a simple JavaScript alert
        echo "<script>
            alert('Job successfully deleted!');
            window.location.href = 'jobs.php'; // Redirect to jobs.php
        </script>";
        exit;
    } else {
        echo "Error deleting data: " . DB::getLastError();
    }
} else {
    // Handle the case when 'remove_id' is not set in the URL
    echo "Invalid request.";
}
?>
