<?php
include 'header.php';
?>
        <!-- partial -->
        <div class="page-content">
          <h4 class="mt-3 mb-3">Create Job Post</h4>
          <div class="row">
            <div class="col-md-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h6 class="card-title">Form Grid</h6> -->
                  <form id="job" method="post">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Job Title</label>
                          <input
                          id="job_title"
                          name="job_title"
                            type="text"
                            class="form-control"
                            placeholder="Enter Job Title"
                          />
                        </div>
                      </div>
                      <!-- Col -->
                      <div class="col-sm-3">
                        <div class="mb-3">
                          <label class="form-label">Select Category </label>
                                <select
                                id="category_id"
                                name="category_id"

                                class="js-example-basic-single form-select"
                                data-width="100%"
                                required
                                >
                                <?php
                                // Fetch categories from the database and populate the options
                                $categories = DB::query("SELECT * FROM categories");
                                foreach ($categories as $category) {
                                    echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                }
                                ?>
                                </select>
                        </div>
                      </div>
                      <!-- Col -->
                      <div class="col-sm-3">
                        <div class="mb-3">
                          <label class="form-label">Budget </label>
                          <input
                            type="number"
                            class="form-control"
                            placeholder="Enter Budget"
                            id="budget"
                            name="budget"
                          />
                        </div>
                      </div>
                    </div>
                    <!-- Row -->
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label">Select Country </label>
                          <select
                               id="country_id"
                                name="country_id"
                                class="js-example-basic-single form-select"
                                data-width="100%"
                                required
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
                      
                     

                      <!-- Col -->
                    </div>
                    <!-- Row -->
                    <div class="row">
                      
                     
                      <!-- Col -->
                      <div class="col-sm-6">
                        <div class="mb-3">
                          <label class="form-label"
                            >Deadline to Apply for this job *</label
                          >
                          <div
                            class="input-group flatpickr"
                            id="flatpickr-date"
                          >
                            <input
                              type="text"
                              class="form-control"
                              placeholder="Select date"
                              data-input
                              id="deadline_date"
                              name="deadline_date"
                            />
                            <span
                              class="input-group-text input-group-addon"
                              data-toggle
                              ><i data-feather="calendar"></i
                            ></span>
                          </div>
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
                          ></textarea>
                        </div>
                      </div>
                      <!-- Col -->
                    </div>
                    <!-- Row -->
                    <button type="submit" class="btn btn-primary submit">
                      Create Job Post
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
    <!-- End custom js for this page -->
    <script src="job_validation.js"></script>
  </body>
</html>
