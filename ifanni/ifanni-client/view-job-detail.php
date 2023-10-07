<?php
include 'header.php';
require_once("ajax/db_connection.php");

// Initialize variables to store job data
$job_id = $job_title = $category_id = $budget = $country_id = $deadline_date = $description = '';

// Check if a job ID is provided via GET request
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // Fetch job data from the database
    $sql = "SELECT * FROM client_job WHERE id = $job_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Extract data
        $job_title = $row['job_title'];
        $category_id = $row['category_id'];
        // $budget = $row['budget'];
        $country_id = $row['country_id'];
        $city_id = $row['city_id'];
        $location = $row['location'];
        $deadline_date = $row['deadline_date'];
        $description = $row['description'];
    }
}


?>

<!-- partial -->
<div class="page-content">
    <h4 class="mt-3 mb-3">View Job  Details</h4>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="update-job-form" method="post" action="update_job_process.php" enctype="multipart/form-data">
                        <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Job Title</label>
                                    <input
                                        id="job_title"
                                        name="job_title"
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter Job Title"
                                        value="<?php echo $job_title; ?>"
                                        disabled
                                    />
                                </div>
                            </div>
                            <!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Select Category</label>
                                    <select
                                        id="category_id"
                                        name="category_id"
                                        class="js-example-basic-single form-select"
                                        data-width="100%"
                                        disabled
                                    >
                                        <?php
                                        // Fetch categories from the database and populate the options
                                        $sql_categories = "SELECT * FROM categories";
                                        $result_categories = $conn->query($sql_categories);

                                        if ($result_categories->num_rows > 0) {
                                            while ($row_category = $result_categories->fetch_assoc()) {
                                                $selected = ($row_category['id'] == $category_id) ? 'selected' : '';
                                                echo '<option value="' . $row_category['id'] . '" ' . $selected . '>' . $row_category['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Select Country</label>
                                    <select
                                        id="country_id"
                                        name="country_id"
                                        class="js-example-basic-single form-select"
                                        data-width="100%"
                                        disabled
                                    >
                                        <?php
                                        // Fetch countries from the database and populate the options
                                        $sql_countries = "SELECT * FROM countries";
                                        $result_countries = $conn->query($sql_countries);

                                        if ($result_countries->num_rows > 0) {
                                            while ($row_country = $result_countries->fetch_assoc()) {
                                                $selected = ($row_country['id'] == $country_id) ? 'selected' : '';
                                                echo '<option value="' . $row_country['id'] . '" ' . $selected . '>' . $row_country['name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Col -->
                            <!--<div class="col-sm-3">
                                <div class="mb-3">
                                    <label class="form-label">Budget</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        placeholder="Enter Budget"
                                        id="budget"
                                        name="budget"
                                    />
                                </div>
                            </div>-->
                        </div>
                        <!-- Row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select
                                        id="city_id"
                                        name="city_id"
                                        class="js-example-basic-single form-select"
                                        data-width="100%"
                                        disabled
                                    >
                                        <?php
                                        // Fetch categories from the database and populate the options
                                        $sql_city = "SELECT * FROM service_cities";
                                        $result_city = $conn->query($sql_city);

                                        if ($result_city->num_rows > 0) {
                                            while ($row_city = $result_city->fetch_assoc()) {
                                                $selected = ($row_city['id'] == $city_id) ? 'selected' : '';
                                                echo '<option value="' . $row_city['id'] . '" ' . $selected . '>' . $row_city['service_city'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Deadline to Apply for this job *</label>
                                    <div class="input-group flatpickr" id="flatpickr-date">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Select date"
                                            data-input
                                            id="deadline_date"
                                            name="deadline_date"
                                            value="<?php echo $deadline_date; ?>"
                                            disabled
                                        />
                                        <span class="input-group-text input-group-addon" data-toggle>
                                            <i data-feather="calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input
                                        id="location"
                                        name="location"
                                        type="text"
                                        class="form-control"
                                        placeholder="Enter Job Title"
                                        value="<?php echo $location; ?>"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                        <!-- Row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea
                                        class="form-control"
                                        name="description"
                                        id="description"
                                        rows="3"
                                        disabled
                                    ><?php echo $description; ?></textarea>
                                </div>
                            </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label"> Images</label>
                                <div id="existing-images-container">
                                    <?php
                                    // Fetch and display existing job images here using a loop
                                    $sql_existing_images = "SELECT files FROM client_job_files WHERE job_id = $job_id";
                                    $result_existing_images = $conn->query($sql_existing_images);

                                    if ($result_existing_images->num_rows > 0) {
                                        while ($row_existing_image = $result_existing_images->fetch_assoc()) {
                                            $image_path = "job_uploads/" . $row_existing_image['files'];
                                            echo "<img src='$image_path' width='100' alt='Image'>";
                                        }
                                    } else {
                                        echo "No existing images available.";
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>
                        </div>
                       

                            <!--<div class="mb-3">
                                <label class="form-label">Upload New Images</label>
                                <input type="file" name="images[]" disabled multiple accept=".jpg, .jpeg, .png, .pdf" class="form-control" id="image-upload-input">
                            </div>--

                        <!-- Row -->
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 

        <!-- partial:partials/_footer.html -->
        <footer
          class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small"
        >
          <p class="text-muted mb-1 mb-md-0">
            Copyright © 2022
            <a href="https://www.ifanni" target="_blank">Ifanni.sa</a>.
          </p>
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
    <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="assets/js/data-table.js"></script>
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- <script src="assets/js/pickr.js"></script> -->
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/vendors/easymde/easymde.min.js"></script>
    <script src="assets/js/easymde.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->
    <!-- <script src="job_validation.js"></script> -->
    <!-- JavaScript to dynamically display image previews -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Input element for image upload
    var imageUploadInput = document.getElementById('image-upload-input');
    
    // Container for displaying image previews
    var existingImagesContainer = document.getElementById('existing-images-container');
    
    // Function to display image previews
    function displayImagePreview(input) {
        if (input.files && input.files.length > 0) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.width = 100; // Set the desired width for the preview image
                    existingImagesContainer.appendChild(img);
                };
                
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
    
    // Event listener for image upload input
    imageUploadInput.addEventListener('change', function() {
        // Clear existing image previews
        existingImagesContainer.innerHTML = '';
        
        // Display image previews for selected files
        displayImagePreview(this);
    });
});
</script>
  </body>
</html>
