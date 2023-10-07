<?php
include 'header.php';
require_once("db_connection.php");
$service_provider_id = $_GET['id'];
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3">Service Provider Contact</h4>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="serviceproviderNotificationForm" method="POST" action="#" >
                    <div class="row">
                    
                    <!-- Row -->

                        <div class="col-sm-6">
                            <div class="mb-3">
                            <label class="form-label">Latest Jobs </label>
                            <select
                                id="notification_id"
                                    name="notification_id"
                                    class="js-example-basic-single form-select"
                                    data-width="100%"
                                    
                                    >
                                    <?php
                                    // Fetch countries from the database and populate the options
                                    $jobs = DB::query("SELECT * FROM client_job
                                    WHERE job_status = '1' order by id DESC
                                    ");
                                    foreach ($jobs as $job) {
                                        echo '<option value="' . $job['id'] . '">' . $job['job_title'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="hidden" id="service_provider_id" name="service_provider_id" value="<?=$service_provider_id?>">
                        </div>
                        <div class="col-sm-12">
                        <div class="mb-3">
                          <label class="form-label">Description</label>
                          <textarea
                            class="form-control"
                            name="description"
                            id="description"
                            rows="10"
                          ></textarea>
                        </div>
                      </div>
                        </div>
                        <!-- Row -->
                    <button type="submit" class="btn btn-primary submit">
                      Send
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
    <!-- <script src="js/city_validation.js"></script> -->
    <script src="assets/js/sweet-alert.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script type="text/javascript">
    $(document).ready(function() {
    $("#serviceproviderNotificationForm").submit(function(e) {
        e.preventDefault(); // Prevent the default form submission behavior

        // Get form data using jQuery's serialize function
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "ajax/insert_service_provider_notification.php", // PHP file to handle the insertion
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Display success message with SweetAlert
                    Swal.fire({
                        title: "Success",
                        text: response.message,
                        icon: "success",
                    });
                } else {
                    // Display error message with SweetAlert
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error",
                    });
                }
            }
        });
    });
});

</script> 

<!-- End custom js for this page -->
  </body>
</html>
