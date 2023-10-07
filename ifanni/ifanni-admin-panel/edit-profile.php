<?php
include 'header.php';
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3">Edit Profile</h4>
          <div class="row">
            <div class="col-md-12 stretch-card">
           
             <div class="card">
              <div class="card-body">
                  <form method="post"  id="add-service-provider-info">
                      <div class="row">
                            <div class="col-sm-4">
                              <div class="mb-3">
                                  <label class="form-label">Your Name</label>
                                  <input
                                      type="text"
                                      class="form-control"
                                      placeholder="Enter Your Name"
                                      id="service_provider_name"
                                      name="service_provider_name"
                                  />
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="mb-3">
                                  <label class="form-label">Email</label>
                                  <input
                                      type="text"
                                      class="form-control"
                                      placeholder="Enter Email"
                                      id="service_provider_email"
                                      name="service_provider_email"
                                  />
                              </div>
                            </div>
                            <div class="col-sm-4">
                              <div class="mb-3">
                                  <label class="form-label">Phone </label>
                                  <input
                                      type="number"
                                      class="form-control"
                                      placeholder="Enter Phone Number"
                                      id="service_provider_phone"
                                      name="service_provider_phone"
                                  />
                              </div>
                            </div>
                            
                            
                           
                            <div class="col-sm-4">
                              <div class="mb-3">
                                  <label class="form-label">Address </label>
                                  <input
                                      type="text"
                                      class="form-control"
                                      placeholder="Enter Phone Number"
                                      id="service_provider_address"
                                      name="service_provider_address"
                                  />
                              </div>
                            </div> 
                      </div>
                      
                      <button type="submit" class="btn btn-primary submit">
                        Update Profile
                      </button>
                      
                  </form>
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
    <script src="service-provider-validation.js"></script>
      
    </script>
  </body>
</html>
