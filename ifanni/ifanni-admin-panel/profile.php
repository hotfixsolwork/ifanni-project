<?php
include 'header.php';

// Include your database connection file
include('db_connection.php');

// Assume you have a $clientId variable containing the client's ID
$clientId = 1; // Replace with the actual client ID you want to display

// Fetch client data from the database
$sql = "SELECT * FROM service_provider WHERE id = $clientId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the client data as an associative array
    $row = $result->fetch_assoc();
    $serviceproviderName = $row['service_provider_name'];
    $serviceproviderEmail = $row['service_provider_email'];
    $serviceproviderPhone = $row['service_provider_phone'];
    $serviceproviderAddress = $row['service_provider_address'];
} else {
    echo "Client not found.";
}

// Close the database connection
$conn->close();

?>
        <!-- partial -->

        <div class="page-content">
          <div class="row profile-body">
            <!-- left wrapper start -->

            <!-- left wrapper end -->
            <!-- middle wrapper start -->
            <div class="col-md-6 col-xl-6 middle-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="card rounded">
                    <div class="card-header">
                      <div
                        class="d-flex align-items-center justify-content-between"
                      >
                        <div class="d-flex align-items-center">
                          
                          
                        </div>
                        <a href="edit-profile.php"><button class="btn btn-primary btn-icon-text">
                          <i data-feather="edit" class="btn-icon-prepend"></i>
                          Edit profile
                        </button></a>
                      </div>
                    </div>
                    <div class="card-body">
                     
                      <div class="d-flex justify-content-between mb-3">
                        <div>
                          <p>Name:</p>
                        </div>
                        <div>
                          <h5><?php echo $serviceproviderName; ?></h5>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between mb-3">
                        <div>
                          <p>Email:</p>
                        </div>
                        <div>
                          <h5><?php echo $serviceproviderEmail; ?></h5>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between mb-3">
                        <div>
                          <p>Address:</p>
                        </div>
                        <div>
                          <h5><?php echo $serviceproviderAddress; ?></h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- middle wrapper end -->
            <!-- right wrapper start -->

            <!-- right wrapper end -->
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
