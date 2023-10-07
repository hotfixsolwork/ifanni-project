<?php
include 'header.php';

// Include your database connection file
include('db_connection.php');
//$id = $_SESSION['client_id'];

// Get the ID from the URL (assuming it's the id from your table)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data from the 'your_table' table
    $sql = "SELECT * FROM service_provider WHERE id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data as an associative array
        $row = $result->fetch_assoc();
        $jobTitle = $row['job_title'];
        // Now you can access the fields from your tables
         $serviceproviderName = $row['service_provider_name'];
         $serviceproviderEmail = $row['service_provider_email'];
         $serviceproviderPhone = $row['service_provider_phone'];
         $serviceproviderAddress = $row['service_provider_address'];
          $serviceproviderAbout = $row['service_provider_about'];

        
        
        // Additional processing and HTML code to display the details
    } else {
        echo "Data not found.";
    }
} else {
    echo "Missing ID in the URL.";
}

// Close the database connection
$conn->close();
?>
        <!-- partial -->
        <div class="page-content">
          
          <div class="row">
            <div class="col-md-6 mx-auto">
            <h4 class="mt-3 mb-3">Service Provider Details</h4>
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form id="viewServicesForm" method="POST"  >
                     <input type="hidden" name="service_provider_id" value="<?php echo $id; ?>">
                     <div class="row d-flex justify-content-between mb-4">
                        <div class="col-md-6">
                          <a href="view_services.php?id=<?php echo $id; ?>" class="btn btn-primary">
                              View All Services
                          </a>

                        </div>
                        <div class="col-md-6">
                            <a href="view_equipments.php?id=<?php echo $id; ?>" class="btn btn-primary">
                                View All Equipment
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Service Provider Name</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  placeholder="Ente Job title"
                                  name="service_provider_name"
                                  id="service_provider_name"
                                  disabled
                                  value="<?php echo  $serviceproviderName; ?>"
                                  
                              />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="mb-3">
                              <label class="form-label">Service Provider Email</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  placeholder="Ente Job title"
                                  name="service_provider_email"
                                  id="service_provider_email"
                                  disabled
                                  value="<?php echo  $serviceproviderEmail; ?>"
                                  
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
                                  name="service_provider_phone"
                                  id="service_provider_phone"
                                  disabled
                                  value="<?php echo  $serviceproviderPhone; ?>"
                                  
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
                                  name="service_provider_address"
                                  id="service_provider_address"
                                  disabled
                                  value="<?php echo  $serviceproviderAddress; ?>"
                                  
                              />
                          </div>
                        </div>
                          <div class="col-sm-12">
                              <div class="mb-3">
                                  <label class="form-label">Description</label>
                                  <textarea
                                      class="form-control"
                                      name="description"
                                      id="description"
                                      rows="10"
                                      disabled
                                  > <?php echo  $serviceproviderAbout; ?></textarea>
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
