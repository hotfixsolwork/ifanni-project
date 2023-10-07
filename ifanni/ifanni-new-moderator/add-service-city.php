<?php
include 'header.php';
require_once("db_connection.php");
?>
        <!-- partial -->
        <div class="page-content">
          <div class="row">
            <div class="col-md-4 mx-auto">
            <h4 class="mt-3 mb-3">Add New City</h4>

            </div>
          </div>
          
          <div class="row">
            <div class="col-md-4 mx-auto">
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="cityForm" method="POST" action="insert_new_city.php" >
                    <div class="row">
                    
                    <!-- Row -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                            <label class="form-label">City Name</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter City Name"
                                name="service_city"
                                id="service_city"
                                
                            />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                            <label class="form-label">Country </label>
                            <select
                                id="country_id"
                                    name="country_id"
                                    class="js-example-basic-single form-select"
                                    data-width="100%"
                                    
                                    >
                                    <?php
                                    // Fetch countries from the database and populate the options
                                    $countries = DB::query("SELECT * FROM countries");
                                    foreach ($countries as $country) {
                                        echo '<option value="' . $country['id'] . '">' . $country['name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                            

                        
                        </div>
                        <!-- Row -->
                    <button type="submit" class="btn btn-primary submit">
                      Create Country
                    </button>
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
    <script src="assets/js/sweet-alert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/city_validation.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
