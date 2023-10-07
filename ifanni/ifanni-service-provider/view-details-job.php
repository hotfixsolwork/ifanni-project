<?php
include 'header.php';
require_once("db_connection.php");
$job_id = $_GET['id'];
$service_provider_id = $_SESSION['service-provider_id'];

$query_job = "SELECT * FROM client_job WHERE id = '$job_id'";
$result_job = $conn->query($query_job);
$job = $result_job->fetch_assoc();

$found = 0;
$query = "SELECT * FROM moderator_job_response_notification WHERE job_id = '$job_id' AND service_provider_id = '$service_provider_id' LIMIT 1";
$result = $conn->query($query);

$price_quote_by_service_provider = "";
$details = '';
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Now you can access all the column values like this:
    $id = $row['id'];
    $details = $row['details'];
    $price_quote_by_service_provider = $row['price_quote_by_service_provider'];
    $job_status = $row['job_status'];

    // ... and so on for other columns

    $found = 1; // Just a message to indicate the row was found; you can remove or modify it.

} else {
    //echo "0";  // Not found
    $found = 0;
}
?>

<!-- partial -->
<div class="page-content">


    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="row">
                <div class="col-md-6 mx-auto mb-4">
                    <h5>View Job Details</h5>
                </div>
                <div class="col-md-6 mx-auto mb-4">
                    <a href="new_job_requests.php"> <buttton class="btn btn-primary">Go Back</buttton></a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class=" mb-4">

                            <div class="">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                        <label class="form-label">Title:</label>
                                        <input
                                        
                                            type="text"
                                            class="form-control"
                                            placeholder="Enter Job Title"
                                            disabled
                                            value="<?php echo $job['job_title']; ?>"
                                        />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea
                                                class="form-control"
                                                rows="3"
                                                disabled
                                            ><?php echo $job['description']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <h3></h3>

                                <?php
                                        // Query to retrieve image files associated with the job
                                        $query_images = "SELECT * FROM client_job_files WHERE job_id = '$job_id'";
                                        $result_images = $conn->query($query_images);

                                        // Check if images are found
                                        if ($result_images->num_rows > 0) {
                                            echo '<h4 class="mt-3 mb-3">Job Files:</h4>';
                                            echo '<div class="row">';
                                            while ($image_row = $result_images->fetch_assoc()) {
                                                $file_name = $image_row['files'];
                                                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION); // Get the file extension
                                                $file_url = '../ifanni-client/job_uploads/' . $file_name; // Adjust the path to your file directory

                                                // Limit the displayed file name to 15 characters
                                                $displayed_file_name = (strlen($file_name) > 15) ? substr($file_name, 0, 15) . '...' : $file_name;

                                                echo '<div class="col-md-6 mb-3">';
                                                echo '<a href="' . $file_url . '" download="' . $file_name . '" class="text-decoration-none">';
                                                echo '<div class="card d-flex flex-row align-items-center justify-content-between  pt-4 pb-4 p-4">';
                                                echo '<div class="d-flex align-items-center text-center">';
                                                
                                                // Display different icons based on file extension
                                                if (in_array($file_extension, ['png', 'PNG'])) {
                                                    echo '<i class="link-icon me-2" data-feather="image"></i>'; // PNG file
                                                } elseif (in_array($file_extension, ['jpg', 'jpeg', 'JPG', 'JPEG'])) {
                                                    echo '<i class="link-icon me-2" data-feather="image"></i>'; // JPG file
                                                } elseif (in_array($file_extension, ['pdf', 'PDF'])) {
                                                    echo '<i class="link-icon me-2" data-feather="file-text"></i>'; // PDF file
                                                } elseif (in_array($file_extension, ['doc', 'docx'])) {
                                                    echo '<i class="link-icon me-2" data-feather="file-text"></i>'; // Word file
                                                } else {
                                                    echo '<i class="link-icon me-2" data-feather="file"></i>'; // Default file icon
                                                }
                                                
                                                echo '<span class="card-title mt-4">' . $displayed_file_name . '</span>';
                                                echo '</div>';
                                                echo '<i class="link-icon me-2" data-feather="download"></i>';
                                                echo '</div>';
                                                echo '</a>';
                                                echo '</div>';
                                            }
                                            echo '</div>';
                                        } else {
                                            echo '<p>No images found for this job.</p>';
                                        }
                                ?>





                            
                                <!-- You can add other fields similarly -->

                                <!-- Price Quote Form -->
                                <h4 class="mt-3">Enter Your Price Quote</h4>
                              
                                <form id="quoteForm" method="post">
                                     <input class="form-label" type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3 mt-3">
                                            <label class="form-label">Price Quote:</label>
                                            <input
                                                id="quote"
                                                name="quote"
                                               
                                                type="text"
                                                class="form-control"
                                                placeholder="Enter Price Quote"
                                                value="<?=$price_quote_by_service_provider?>"
                                            />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea
                                                class="form-control"
                                                id="details"
                                                name="details"
                                                rows="3"
                                                
                                            ><?=$details?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row -->
                                    <?php
                                    if($found == 0){


                                    ?>
                                    <button type="submit" class="btn btn-primary submit">
                                    Send Response To Admin
                                    </button>
                                    <?php
                                    }
                                    ?>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- partial:partials/_footer.html -->
    <footer
        class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small"
    >

    </footer>
    <!-- partial -->
</div>
</div>

<!-- core:js -->
<script src="assets/vendors/core/core.js"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
<script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="assets/vendors/feather-icons/feather.min.js"></script>
<script src="assets/js/template.js"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="assets/js/dashboard-light.js"></script>
<script src="assets/js/sweet-alert.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
        $(document).ready(function() {
            $('#quoteForm').submit(function(e) {
                e.preventDefault(); // Prevents the default form submit action

                // Gather the form data
                let formData = $(this).serialize();

                $.ajax({
                    type: "POST",
                    url: "assets/ajax/submit_quote_ajax.php", // Change to your AJAX processing file
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            // Display success message with SweetAlert
                            Swal.fire({
                                title: "Success",
                                text: response.message,
                                icon: "success",
                            });
                        } else {
                            // Display error message with SweetAlert
                            Swal.fire({
                                title: "Error",
                                text: response.message,
                                icon: "error",
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Handle any errors
                        console.error("Error: ", textStatus, errorThrown);
                        Swal.fire({
                            title: "Error",
                            text: "There was an error processing your request.",
                            icon: "error",
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>





