<?php
include 'header.php';

// Include your database connection file
include('db_connection.php');

// Initialize variables
$sps_id = $service_title = $description = $category = $country = $city = $service_provider_name = $service_provider_email = $service_provider_phone = '';

// Get the ID from the URL
if (isset($_GET['sps_id'])) {
    $sps_id = $_GET['sps_id'];

    // Fetch data from the database based on sps_id
    $sql = "SELECT 
                sps.id AS sps_id,
                sps.service_title,
                sps.description,
                cat.name AS category,
                cou.name AS country,
                cit.service_city AS city,
                sp.service_provider_name,
                sp.service_provider_email,
                sp.service_provider_phone,
                sp.service_provider_address,
                sp.service_provider_about
            FROM service_provider_service AS sps
            INNER JOIN categories AS cat ON sps.category_id = cat.id
            INNER JOIN countries AS cou ON sps.country_id = cou.id
            INNER JOIN service_cities AS cit ON sps.city_id = cit.id
            INNER JOIN service_provider AS sp ON sps.service_provider_id = sp.id
            WHERE sps.id = $sps_id";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Extract data
            $sps_id = $row['sps_id'];
            $service_title = $row['service_title'];
            $description = $row['description'];
            $category = $row['category'];
            $country = $row['country'];
            $city = $row['city'];
            $service_provider_name = $row['service_provider_name'];
            $service_provider_email = $row['service_provider_email'];
            $service_provider_phone = $row['service_provider_phone'];
            $service_provider_address = $row['service_provider_address'];
            $service_provider_about = $row['service_provider_about'];
        } else {
            echo "Data not found.";
        }
    } else {
        echo "Error executing the SQL query: " . $conn->error;
    }
} else {
    echo "Missing sps_id in the URL.";
}

// Close the database connection
$conn->close();
?>

        <!-- partial -->
        <div class="page-content">
          
          <div class="row">
            <div class="col-md-6 mx-auto">
             <h4 class="mt-3 mb-3">Service Details</h4>
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
                                  value="<?php echo $service_title; ?>"
                                  
                              />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Service About</label>
                              <input
                                  type="text"
                                  class="form-control"
                                 
                                  disabled
                                  value="<?php echo $description; ?>"
                                  
                              />
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Service Category</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    
                                    disabled
                                    value="<?php echo $category; ?>"
                                    
                                />
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Service Country</label>
                              <input
                                  type="text"
                                  class="form-control"
                                 
                                  disabled
                                  value="<?php echo $country; ?>"
                                  
                              />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Service City</label>
                              <input
                                  type="text"
                                  class="form-control"
                                 
                                  disabled
                                  value="<?php echo $city; ?>"
                                  
                              />
                          </div>
                        </div>
                    </div>
                  </form>
                  
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
