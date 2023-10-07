<?php
include 'header.php';

// Include your database connection file
include('db_connection.php');

// Get the ID from the URL (assuming it's the id from your table)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data from the 'your_table' table
    $sql = "SELECT j.id, j.job_title,j.description, j.budget, c.client_name AS client_name, c.client_email AS client_email, c.client_phone AS client_phone, c.client_adress AS client_adress,c.client_about AS client_about
    FROM client_job j
    INNER JOIN clients c ON j.client_id = c.id
            WHERE j.id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data as an associative array
        $row = $result->fetch_assoc();
    
        // Now you can access the fields from your tables
        $clientName = $row['client_name'];
        $clientEmail = $row['client_email'];
        $clientPhone = $row['client_phone'];
        $clientAddress = $row['client_adress'];
        $clientAbout = $row['client_about'];

        $jobDetails = $row['job_title'];
       // $price = $row['price_quote_by_service_provider'];
     //   $name = $row['client_name']; // Assuming 'job_details' is a field in the 'client_job' table
        $description = $row['description']; // Assuming 'client_name' is a field in the 'client_job' table
      //  $clientEmail = $row['client_email']; // Assuming 'client_email' is a field in the 'client_job' table
     //   $clientPhone = $row['client_phone']; // Assuming 'client_phone' is a field in the 'client_job' table
        
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
            <h4 class="mt-3 mb-3">Job Details</h4>
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="#" method="POST" action="#" >
                    <div class="row">
                        <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Job Title</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Ente Job title"
                                        name="job_title"
                                        id="job_title"
                                        disabled
                                        value="<?php echo $jobDetails; ?>"
                                        
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
                                    > <?php echo $description; ?></textarea>
                                </div>
                        </div>
                        </div>
                        <!-- Row -->
                  </form>
                  
                </div>
              </div>
              
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mx-auto">
            <h4 class="mt-3 mb-3">Client Details</h4>
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="#" method="POST" action="#" >
                    <div class="row">
                        <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Name</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Ente Job title"
                                        name="client_name"
                                        id="client_name"
                                        disabled
                                        value="<?php echo $clientName; ?>"
                                        
                                    />
                                </div>
                        </div>
                        <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Email</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Ente Job title"
                                        name="client_email"
                                        id="client_email"
                                        disabled
                                        value="<?php echo $clientEmail; ?>"
                                        
                                    />
                                </div>
                        </div>
                        <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Phone </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Ente Job title"
                                        name="client_phone"
                                        id="client_phone"
                                        disabled
                                        value="<?php echo $clientPhone; ?>"
                                        
                                    />
                                </div>
                        </div>
                        <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Address </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Ente Job title"
                                        name="client_address"
                                        id="client_address"
                                        disabled
                                        value="<?php echo $clientAddress; ?>"
                                        
                                    />
                                </div>
                        </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">About</label>
                                    <textarea
                                        class="form-control"
                                        name="description"
                                        id="description"
                                        rows="10"
                                        disabled
                                    > <?php echo $clientAbout; ?></textarea>
                                </div>
                            </div>

                        </div>
                        <!-- Row -->
                      <!--<button id="confirm-button" class="btn btn-primary submit">
                      Confirmed
                    </button>
                    <button id="rejected-button" class="btn btn-danger ">
                      Rejected
                    </button>-->
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
    <!-- <script src="js/city_validation.js"></script> -->
<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#confirm-button').click(function() {
            var viewId = '<?php echo $_GET['view_id']; ?>';  // Getting the ID from PHP

            // Making an AJAX call for the "Confirmed" action
            $.ajax({
                type: "POST",
                url: "ajax/process_request.php",
                data: {action: 'confirmed', id: viewId, message: $("#message").val()},
                success: function(response) {
                    alert(response);
                },
                error: function() {
                    alert("Error processing the request.");
                }
            });
        });

        $('#rejected-button').click(function() {
            var viewId = '<?php echo $_GET['view_id']; ?>';  // Getting the ID from PHP

            // Making an AJAX call for the "Rejected" action
            $.ajax({
                type: "POST",
                url: "ajax/process_request.php",
                data: {action: 'rejected', id: viewId, message: $("#message").val()},
                success: function(response) {
                    alert(response);
                },
                error: function() {
                    alert("Error processing the request.");
                }
            });
        });
    });
</script>-->






<!-- End custom js for this page -->
  </body>
</html>
