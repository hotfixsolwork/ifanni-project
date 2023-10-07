<?php
include 'header.php';
require_once("db_connection.php");
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3">Add Invoice</h4>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form  id="invocieForm" method="POST" action="#" >
                    <div class="row">
                    
                    <!-- Row -->

                        <div class="col-sm-6">
                            <div class="mb-3">
                            <label class="form-label">Create Invoice </label>
                            <select
                                id="job_id"
                                    name="job_id"
                                    class="js-example-basic-single form-select"
                                    data-width="100%"
                                    
                                    >
                                    <?php
                                    // Fetch countries from the database and populate the options
                                    $jobs = DB::query("SELECT * FROM moderator_job_response_notification
                                    WHERE job_status = 'confirmed' AND invoice_sent = 0
                                    ");


                                    foreach ($jobs as $job) {

                                        $getJobname = DB::queryfirstRow("select * from client_job where id = '".$job['job_id']."'");


                                        echo '<option  data-custom-attribute1="'.$job['id'].'" value="' . $getJobname['id'] . '">' . $getJobname['job_title'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <p><span id="customAttribute1"></span></p>
                        <div class="col-sm-6">
                            <div class="mb-3">
                               <label class="form-label">Payment </label>
                               <div class="input-group">
                                    
                                    <input type="text" class="form-control mb-4 mb-md-0" id="payment"
                                     name="payment" />
                                    <button type="button" class="btn btn-inverse-secondary minus">SAR</button>
                                    
                                </div>
                               <!--<input
                                    type="number"
                                    class="form-control"
                                    placeholder="Enter Payment"
                                    id="payment"
                                    name="payment"
                                />-->
                                  </div>
                        </div> 
                        
                        <input type="hidden" name="main_id" id="main_id">
                        <div class="col-sm-6">
                            <div class="mb-3">
                               <label class="form-label">Payment Deadline </label>
                               <div
                            class="input-group flatpickr"
                            id="flatpickr-date"
                          >
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Select date"
                              data-input
                              id="due_date"
                              name="due_date"
                            />
                            <span
                              class="input-group-text input-group-addon"
                              data-toggle
                              ><i data-feather="calendar"></i
                            ></span>
                            </div>
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
    <script src="invoice_validation.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- End custom js for this page -->
  </body>
</html>
