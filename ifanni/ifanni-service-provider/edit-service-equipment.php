<?php
include 'header.php';
require_once("ajax/db_connection.php");

// Initialize variables to store equipment data
$equipment_id = $equipment_name = $equipment_details = '';
$equipment_images = [];

// Check if an equipment ID is provided via GET request
if (isset($_GET['equipment_id'])) {
    $equipment_id = $_GET['equipment_id'];

    // Fetch equipment data from the database
    $sql = "SELECT * FROM service_provider_equipment WHERE id = $equipment_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Extract data
        $equipment_name = $row['name'];
        $equipment_details = $row['details'];
    }
}

// Handle form submission for updating equipment data

?>

<!-- HTML form for updating equipment details and images -->
<div class="page-content">
    <h4 class="mt-3 mb-3">Update Equipment</h4>
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <form id="update-equipment-form" method="post" action="update_equipment_process.php" enctype="multipart/form-data">
                        <input type="hidden" name="equipment_id" value="<?php echo $equipment_id; ?>">
                        <div class="mb-3">
                            <label class="form-label">Equipment Name</label>
                            <input
                                id="equipment_name"
                                name="equipment_name"
                                type="text"
                                class="form-control"
                                placeholder="Enter Equipment Name"
                                value="<?php echo $equipment_name; ?>"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Equipment Details</label>
                            <textarea
                                class="form-control"
                                name="equipment_details"
                                id="equipment_details"
                                rows="5"
                            ><?php echo $equipment_details; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Existing Images</label>
                            <div id="existing-images-container">
                                <?php
                                // Fetch and display existing equipment images here using a loop
                                $sql_existing_images = "SELECT images FROM service_provider_equipment_images WHERE service_provider_equipment_id = $equipment_id";
                                $result_existing_images = $conn->query($sql_existing_images);

                                if ($result_existing_images->num_rows > 0) {
                                    while ($row_existing_image = $result_existing_images->fetch_assoc()) {
                                        $image_path = "equipment_uploads/" . $row_existing_image['images'];
                                        echo "<img src='$image_path' width='100' alt='Image'>";
                                    }
                                } else {
                                    echo "No existing images available.";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload New Images</label>
                            <input type="file" name="images[]" multiple accept="image/*" class="form-control" id="image-upload-input">
                            <small>Add Multiply Images*</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Equipment</button>
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
    <script src="assets/js/pickr.js"></script>
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/vendors/easymde/easymde.min.js"></script>
    <script src="assets/js/easymde.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->
    <!-- <script src="job_validation.js"></script> -->
    <!-- JavaScript to dynamically display image previews -->
<!-- SweetAlert2 JavaScript -->
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
