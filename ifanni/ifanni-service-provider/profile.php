<?php
include 'header.php';

// Include your database connection file
include('db_connection.php');

$id = $_SESSION['service-provider_id'];

// Define variables to store updated data
// Define variables to store updated data
$serviceproviderName = $serviceproviderEmail = $serviceproviderPhone = $serviceproviderAddress = $serviceproviderAbout = ''; // Only the company name is needed

// Fetch client data from the database
$sql = "SELECT sp.*, c.name AS company_name
FROM service_provider sp
INNER JOIN company c ON sp.company_id = c.id
WHERE sp.id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the client data as an associative array
    $row = $result->fetch_assoc();
    $serviceproviderName = $row['service_provider_name'];
    $serviceproviderEmail = $row['service_provider_email'];
    $serviceproviderPhone = $row['service_provider_phone'];
    $serviceproviderAddress = $row['service_provider_address'];
    $serviceproviderAbout = $row['service_provider_about'];
    $companyName = $row['company_name'];
   
} else {
    echo "Service Provider not found.";
}

// Check if the form has been submitted


// Close the database connection
$conn->close();

?>
        <!-- partial -->

        <div class="page-content">
          
          <div class="row">
            <div class="col-md-6 mx-auto">
            <h4 class="mt-3 mb-3">Profile</h4>
           
             <div class="card">
             
              <div class="card-body">
                  <div class="row">
                      <div class="col text-right">
                        <a href="edit-profile.php">
                            <button style="float:right;" class="btn btn-primary">
                                Edit Profile
                            </button>
                        </a>

                        </div>
                      </div>
                 
                  <form method="post"  id="update-profile-form">
                      
                      <div class="row">
                        <div class="col-md-12 mx-auto">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mb-3">
                                <label class="form-label">Your Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Your Name"
                                    id="service_provider_name"
                                    name="service_provider_name"
                                    value="<?php echo $serviceproviderName; ?>"
                                    disabled
                                />
                              </div>
                              
                              <div class="mb-3">
                                <label class="form-label">Phone </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Phone Number"
                                    id="service_provider_phone"
                                    name="service_provider_phone"
                                    value="<?php echo $serviceproviderPhone; ?>"
                                    disabled
                                />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Company </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Phone Number"
                                    id="company_id"
                                    name="company_id"
                                    value="<?php echo $companyName; ?>"
                                    disabled
                                />
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Address </label>
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Enter Your Address"
                                    id="service_provider_address"
                                    name="service_provider_address"
                                    value="<?php echo $serviceproviderAddress; ?>"
                                    disabled
                                />
                              </div>
                              
                              <div class="col-sm-12">
                                <div class="mb-3">
                                  <label class="form-label">Description</label>
                                  <textarea
                                      class="form-control"
                                      rows="3"
                                      id="service_provider_about"
                                      name="service_provider_about"
                                      disabled
                                  ><?php echo $serviceproviderAbout; ?></textarea>
                                  
                                </div>
                              </div>


                            </div>

                          </div>
                        </div> 
                        <!-- <button type="submit" class="btn btn-primary submit"> -->
                        <!-- Update Profile -->
                      <!-- </button> -->
                      </div>
                      
                      
                      
                      
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
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-light.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
