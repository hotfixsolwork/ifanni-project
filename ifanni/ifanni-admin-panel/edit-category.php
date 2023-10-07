<?php
include 'header.php';

// Include your database connection file
include('db_connection.php');


// Get the ID from the URL (assuming it's the id from your table)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch data from the 'your_table' table
    $sql = "SELECT * FROM categories WHERE id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data as an associative array
        $row = $result->fetch_assoc();
        
        // Now you can access the fields from your tables
        $Name = $row['name'];
        $Des = $row['description'];
       

        // $jobDetails = $row['job_title'];
       // $price = $row['price_quote_by_service_provider'];
     //   $name = $row['client_name']; // Assuming 'job_details' is a field in the 'client_job' table
        // $description = $row['description']; // Assuming 'client_name' is a field in the 'client_job' table
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
              <h4 class="mt-3 mb-3">Edit Category</h4>
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="#" method="POST" action="update_category.php">
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="mb-3">
                              <label class="form-label">Category Name</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  placeholder="Ente Category title"
                                  name="name"
                                  id="name"
                                 
                                  value="<?php echo $Name; ?>"
                                  
                              />
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Category description</label>
                              <textarea
                                  type="text"
                                  class="form-control"
                                  placeholder="Ente Description"
                                  name="description"
                                  id="description"
                                 
                                 
                                  
                              /><?php echo $Des; ?></textarea>
                          </div>
                        </div>
                       
                        
                    </div>
                       
                        <div class="row mb-3">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <div class="col-md-4 justify-content-center">
                               <button id="confirm-button" class="btn btn-primary submit">
                                Update Category
                                </button>

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
