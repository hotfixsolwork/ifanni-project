<?php
include 'header.php';
// Include your database connection file
include('db_connection.php');

// Get the ID from the URL or some other source
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to retrieve service cities with country names
    $sql = "
        SELECT sc.id, sc.service_city, c.name AS country_name, sc.create_date
        FROM service_cities sc
        INNER JOIN countries c ON sc.country_id = c.id
        WHERE sc.id = $id
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Access data from the query result
        $serviceCity = $row['service_city'];
        $countryName = $row['country_name'];
     //   $createDate = $row['create_date'];
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
              <h4 class="mt-3 mb-3">Edit City</h4>
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="#" method="POST" action="#" >
                    <div class="row">
                        <div class="col-sm-12">
                          <div class="mb-3">
                              <label class="form-label"> City</label>
                              <input
                                  type="text"
                                  class="form-control"
                                  placeholder="Ente Job title"
                                  name="name"
                                  id="name"
                                 
                                  value="<?php echo $serviceCity; ?>"
                                  
                              />
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="mb-3">
                              <label class="form-label">Country</label>
                              <select id="country" name="country">
                                
                            </select>
                            <select
                                id="country_id"
                                    name="country_id"
                                    class="js-example-basic-single form-select"
                                    data-width="100%"
                                    
                                    >
                                    <?php
                                // Populate the select options with country names
                                echo "<option value='$countryName'>$countryName</option>";
                                ?>
                                </select>
                              
                          </div>
                        </div>   
                    </div>
                       
                        <div class="row mb-3">
                            <div class="col-md-4 justify-content-center">
                               <button id="confirm-button" class="btn btn-primary submit">
                                Update City
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
