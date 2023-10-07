<?php
include 'header.php';
require_once("ajax/db_connection.php");

// Check if the equipment ID is set in the URL
if (isset($_GET['sps_id'])) {
    $equipmentId = $_GET['sps_id'];

    // Query to retrieve equipment details by ID
    // Query to retrieve equipment details by ID along with country, city, and category
            // Query to retrieve equipment details by ID
                $sql = "SELECT 
                spe.id AS equipment_id,
                spe.name AS equipment_name,
                spe.details AS equipment_details,
                spe.availability_status AS equipment_status,
                sp.service_provider_name,
                sp.service_provider_phone,
                sp.service_provider_email,
                sp.service_provider_about,
                sp.service_provider_address,
                spi.images AS equipment_images
                FROM service_provider_equipment AS spe
                INNER JOIN service_provider AS sp ON spe.service_provider_id = sp.id
                LEFT JOIN service_provider_equipment_images AS spi ON spe.id = spi.service_provider_equipment_id
                WHERE spe.id = $equipmentId";



    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign retrieved data to variables
        $equipment_name = $row["equipment_name"];
        $equipment_details = $row["equipment_details"];
       // $category = $row["equipment_category"]; // Make sure to replace with the actual category column name
       // $country = $row["equipment_country"]; // Make sure to replace with the actual country column name
      //  $city = $row["equipment_city"]; // Make sure to replace with the actual city column name
        $service_provider_name = $row["service_provider_name"];
        $service_provider_email = $row["service_provider_email"]; // Make sure to replace with the actual email column name
        $service_provider_phone = $row["service_provider_phone"];
        $service_provider_address = $row["service_provider_address"]; // Make sure to replace with the actual address column name
        $service_provider_about = $row["service_provider_about"]; // Make sure to replace with the actual about column name
    } else {
        echo "Equipment not found.";
    }
} else {
    echo "Equipment ID not provided.";
}

// Close the database connection
$conn->close();
?>

<!-- HTML content for displaying equipment and service provider details goes here -->

<!-- HTML content for displaying equipment details goes here -->

        <!-- partial -->
        <div class="page-content">
          
          <div class="row">
            <div class="col-md-6 mx-auto">
             <h4 class="mt-3 mb-3">Equipment  Details</h4>
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="#" method="POST" action="#" >
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Name</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  placeholder=""
                                  
                                  disabled
                                  value="<?php echo $equipment_name; ?>"
                                  
                              />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Equipment About</label>
                              <input
                                  type="text"
                                  class="form-control"
                                 
                                  disabled
                                  value="<?php echo $equipment_details; ?>"
                                  
                              />
                          </div>
                        </div>
                        
                    </div>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
          <!-- Existing code for service provider details -->

<!-- Add a new section for equipment images -->
<div class="row">
    <div class="col-md-6 mx-auto">
        <h4 class="mt-3 mb-3">Equipment Images</h4>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php
                    // Split the image URLs into an array
                    $imageUrls = explode(',', $row["equipment_images"]);

                    // Loop through the image URLs and display them
                    foreach ($imageUrls as $imageUrl) {
                        // Construct the full image path
                        $fullImageUrl = '../ifanni-service-provider/equipment_uploads/' . $imageUrl;

                        // Check if the image file exists before displaying it
                        if (file_exists($fullImageUrl)) {
                            echo '<div class="col-md-4 mb-3">';
                            echo '<img src="' . $fullImageUrl . '" class="img-fluid img-thumbnail" alt="Equipment Image">';
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

          <div class="row">
            <div class="col-md-6 mx-auto">
             <h4 class="mt-3 mb-3">Service Provider  Details</h4>
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="#" method="POST" action="#" >
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Service Provider Name</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  placeholder=""
                                  
                                  disabled
                                  value="<?php echo $service_provider_name; ?>"
                                  
                              />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Service Provider Email</label>
                              <input
                                  type="text"
                                  class="form-control"
                                 
                                  disabled
                                  value="<?php echo $service_provider_email; ?>"
                                  
                              />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="mb-3">
                              <label class="form-label">Service Provider Phone </label>
                              <input
                                  type="text"
                                  class="form-control"
                                  placeholder="Ente Job title"
                                 
                                  disabled
                                  value="<?php echo $service_provider_phone; ?>"
                                  
                              />
                          </div>
                    </div>
                        <div class="col-sm-12">
                          <div class="mb-3">
                              <label class="form-label">Service Provider Address </label>
                              <input
                                  type="text"
                                  class="form-control"
                                  placeholder="Ente Job title"
                                 
                                  disabled
                                  value="<?php echo $service_provider_address; ?>"
                                  
                              />
                          </div>
                        </div>
                          <div class="col-sm-12">
                              <div class="mb-3">
                                  <label class="form-label">About </label>
                                  <textarea
                                      class="form-control"
                                      
                                      rows="10"
                                      disabled
                                  > <?php echo $service_provider_about; ?></textarea>
                              </div>
                          </div>

                        </div>
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
    <script src="assets/js/pickr.js"></script>
    <script src="assets/js/flatpickr.js"></script>
    <script src="assets/vendors/easymde/easymde.min.js"></script>
    <script src="assets/js/easymde.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    






<!-- End custom js for this page -->
  </body>
</html>
